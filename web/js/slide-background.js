let cycleBackgrounds = _ => {
    let index = 0;

    $imageEls = $('.container-fluid .slide');

    setInterval(function() {
        index = index + 1 < $imageEls.length ? index + 1 : 0;
        $imageEls.eq(index).addClass('show');
        $imageEls.eq(index - 1).removeClass('show');
    }, 7000);
};

$(function() {
    cycleBackgrounds();
});