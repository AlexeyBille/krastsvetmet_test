<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLinkRequest;
use App\Models\Link;
use App\Service\LinkService;
use App\Service\LinkStatisticService;
use App\Utils\ShortUrlGenerator;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LinkController extends Controller
{

    /**
     * @var ShortUrlGenerator
     */
    private $shortUrlGenerator;
    /**
     * @var LinkService
     */
    private $linkService;
    /**
     * @var LinkStatisticService
     */
    private $linkStatisticService;

    /**
     * LinkController constructor.
     * @param ShortUrlGenerator $shortUrlGenerator
     * @param LinkService $linkService
     * @param LinkStatisticService $linkStatisticService
     */
    public function __construct(
        ShortUrlGenerator $shortUrlGenerator,
        LinkService $linkService,
        LinkStatisticService $linkStatisticService
    )
    {
        $this->shortUrlGenerator    = $shortUrlGenerator;
        $this->linkService          = $linkService;
        $this->linkStatisticService = $linkStatisticService;
    }

    /**
     * Список всех ссылок
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('link.index', [
            'links' => $this->linkService->getAll()
        ]);
    }

    /**
     * Форма создания ссылки
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('link.create');
    }

    /**
     * Создание ссылки
     *
     * @param StoreLinkRequest $request
     * @return Application|Factory|View
     */
    public function store(StoreLinkRequest $request)
    {
        $clientTimezone = $request->get('timezone');
        $expiresAt      = $request->get('expires_at');

        if ($expiresAt) {
            $expiresAt = Carbon::createFromFormat('Y-m-d\TH:i', $expiresAt);
            $expiresAt->addMinutes($clientTimezone);
        }

        $link = new Link();

        $link->url           = $request->get('url');
        $link->short_uri     = $request->get('short_uri') ?: $this->shortUrlGenerator->generate();
        $link->expires_at    = $expiresAt;
        $link->is_commercial = !!$request->get('is_commercial');

        $this->linkService->store($link);

        return view('link.store', compact('link'));
    }

    /**
     * Детальная информация по ссылке
     *
     * @param Link $link
     * @return Application|Factory|View
     */
    public function show(Link $link)
    {
        return view('link.show', compact('link'));
    }

    /**
     * Переход по ссылке + зачет в статистике
     *
     * @param Request $request
     * @param $uri
     * @return Application|Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|View
     */
    public function visit(Request $request, $uri)
    {
        $link = $this->linkService->getValidLinkByUri($uri);

        if (!$link) {
            abort(404);
        }

        $linkStatistic = $this->linkStatisticService->reach($link, $request->getClientIp());

        if (!$link->is_commercial) {
            return redirect($link->url);
        }

        return view('link.visit', compact('link', 'linkStatistic'));
    }
}
