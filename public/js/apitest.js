$(function () {
    $('#js-test-api-form').on('submit', function (e) {
        e.preventDefault();

        var form = $(this);

        axios
            .post(form.attr('action'), form.serialize())
            .then(function (value) {
                $('#js-api-test-result').empty().text(JSON.stringify(value.data));
            })
            .catch(function (reason) {
                $('#js-api-test-result').text(JSON.stringify(reason));
            });

    });

});