class RevealScroll {
    constructor(elements, offset) {
        this.itemsToReveal = elements;
        this.offset = offset;
        this.hideInitially();
        this.myWayPoints();
    }

    hideInitially() {
        this.itemsToReveal.addClass('reveal-item');
    }

    myWayPoints() {
        const that = this;
        this.itemsToReveal.each(function() {
            let currentItem = this;
            new Waypoint({
                element: currentItem,
                handler: function() {
                    $(currentItem).addClass("reveal-item__on-scroll");
                },
                offset: that.offset
            });
        })
    }

}
