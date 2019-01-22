$(function () {
    var $sections = $('.form-section');

    function navigateTo(index) {
        // Mark the current section with the class 'current'
        $sections
        .removeClass('current')
        .eq(index)
        .addClass('current');
        // Show only the navigation buttons that make sense for the current section:
        /*$('.wizard-control[href="#previous"]').toggle(index > 0);*/
        var atTheEnd = index >= $sections.length - 1;

        /*$('.wizard-control[href="#next"]').toggle(!atTheEnd);
        $('.wizard-control[href="#finish"]').toggle(atTheEnd);*/
    }

    function curIndex() {
        // Return the current index by looking at which section has the class 'current'
        return $sections.index($sections.filter('.current'));
    }

    // Previous button is easy, just go back
    $('.wizard-control[href="#previous"]').click(function() {
        // navigateTo(curIndex() - 1);
        $("#wizard").steps('previous');
    });

    // Next button goes forward iff current block validates
    $('.wizard-control[href="#next"]').click(function() {
        $('.frmRegistration').parsley().whenValidate({
            group: 'block-' + curIndex()
        }).done(function() {
            $("#wizard").steps('next');
            //navigateTo(curIndex() + 1);
        });
    });

    // Prepare sections by setting the `data-parsley-group` attribute to 'block-0', 'block-1', etc.
    $sections.each(function(index, section) {
        $(section).find(':input').attr('data-parsley-group', 'block-' + index);
    });
    navigateTo(0); // Start at the beginning
});
