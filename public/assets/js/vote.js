$(document).ready(function () {
    $(document).on('click', '.vote-plus', function () {
        vote($(this), 1);
    })
    $(document).on('click', '.vote-minus', function () {
        vote($(this), 0);
    })

    const vote = (el, vote) => {
        $.ajax({
            url: "/answer/" + el.attr('data-id'),
            type: "POST",
            data: {vote},
            headers: {
                "X-CSRF-Token": $('meta[name="csrf-token"]').attr('content'),
            },
            success: (r) => {
                alert(r.message);
                window.location.reload();
            },
        });
    }
})
