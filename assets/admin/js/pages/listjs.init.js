var options = {
    valueNames: [
        'id',
        'status',
        'name',
        'email',
        'phone',
        'date',
        'one',
        'two',
        'three',
        'four',
        'five',
        'six',
        'seven',
        'eight',
        'nine',
        'ten',
    ],
    page: 20,
    pagination: {
        innerWindow: 2,
        outerWindow: 1,
        paginationClass: "listjs-pagination"
    }
};

var customerList = new List("customerList", options);

// Fix noresult display
customerList.on("updated", function(list) {
    if (list.matchingItems.length === 0) {
        document.querySelector(".noresult").style.display = "block";
    } else {
        document.querySelector(".noresult").style.display = "none";
    }
});
