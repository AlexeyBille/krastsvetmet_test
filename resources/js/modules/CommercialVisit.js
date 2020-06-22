export const CommercialVisit = () => {
    const visitUrlNode = $('#visit_url');
    const timerNode = $('#timer');

    if (visitUrlNode.length === 0) {
        return;
    }

    setTimeout(() => {
        window.location.href = visitUrlNode.data('url');
    }, 5000);

    setInterval(() => {
        const currentTime = timerNode.text();
        timerNode.text(currentTime <= 0 ? currentTime : currentTime - 1);
    }, 1000);

};

