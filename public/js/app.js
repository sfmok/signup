var form = $("#contact");
form.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); }
});
form.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    onStepChanging: function (event, currentIndex, newIndex)
    {
        if(currentIndex > newIndex) {
            return true;
        }

        $.ajax({
            type: "POST",
            url: '/signup/ajax-save-step',
            data: form.serialize(),
            success: function(response) {

            }

        });
        return form.valid();

    },
    onFinishing: function (event, currentIndex)
    {
        return form.valid();
    },
    onFinished: function (event, currentIndex)
    {
        form.submit();
    }
});