jQuery(document).ready(function ($) {
    console.log('Redirection plugin initialized!');

    /**
     * AJAX request after submit
     */
    $('#b-content').on('click', 'input[type="submit"]', function (e) {
        e.preventDefault();
        let parent = $(this).parent('form');
        let blockID = $(parent).parent('.block-wrapper').attr('id').slice(5);
        let slugExistence = $(parent).find('[name="slug"]').val();
        let checkboxStatus = $(parent).find('[name="cenable"]').prop("checked");
        var data = {
            action: 'rp_data',
            id: blockID,
            cenable: +checkboxStatus,
            cname: $(parent).find('[name="cname"]').val(),
            slug: $(parent).find('[name="slug"]').val(),
            rurl: $(parent).find('[name="rurl"]').val()
        };

        if (slugExistence != '') {
            jQuery.post(ajaxurl, data, function (response) {
                console.log('The data was recorded: "' + response + '"');
                swal("Saving change", "The data was recorded to database", "success");
            });
        } else {
            swal("Wrong data", "Please fill in the slug field", "warning");
        }
    });

    /**
     * AJAX request after delete
     */
    $('#b-content').on('click', 'input[type="button"]', function (e) {
        // console.log($(this).siblings('input[type="submit"]').val('Save'));
        let currentBtnId = ($(this).attr('id'));
        let dataDeleteID = $(this).parent('form').parent('.block-wrapper').prev('.hidden').attr('data-id');
        if (currentBtnId == dataDeleteID) {
            e.preventDefault();
            let parent = $(this).parent('form');
            let blockID = $(parent).parent('.block-wrapper').attr('id').slice(5);
            if ($(this).parent('form').parent('.block-wrapper').is('.block-wrapper:last')) {
                $(parent).children('input[type="text"]').each(function () {
                    $(this).attr('value', '');
                });
                $(this).siblings('input[type="submit"]').val('Save');
                $(this).remove();
            } else {
                $(parent).parent('.block-wrapper').remove();
            }
            var data = {
                action: 'rp_delete',
                id: blockID,
            };
            if (currentBtnId !== undefined) {
                jQuery.post(ajaxurl, data, function (response) {
                    console.log('Data has been deleted');
                    swal("Remove redirect", "Data has been deleted from database", "success");
                });
            }
        }
    });


    /**
     * Rendering tab content
     */
    $('#btnTypical').on('click', function (e) {
        e.preventDefault();
        let parent = $(this).siblings('.block-wrapper');
        let i = $(parent).last().attr('id').slice(5);
        i++;
        let tabContent = `
            <div class="block-wrapper" id="block${i}">
                <form action="/action_page.php">
                    <label for="cenable" class="check"><input type="checkbox" id="cenable" name="cenable" value="active">Enable of redirect</label>
                    <label for="cname">Cookie name:</label>
                    <input type="text" name="cname">
                    <label for="slug">Name of slug:</label>
                    <input type="text" name="slug">
                    <label for="rurl">Url to redirect:</label>
                    <input type="text" name="rurl"><br>
                    <input type="submit" value="Save"><input type="button" value="Delete">
                </form> 
            </div>
        `;
        $("#btnTypical").before(tabContent);
    });

});