/**
 * Created by Hansen on 7/25/2016.
 */

var kospermindoMailbox = kospermindoMailbox || {};

(function ($, window, undefined) {
    "use strict";

    $(document).ready(function()
    {
        kospermindoMailbox.$container = $(".mail-env");

        $.extend(kospermindoMailbox, {
            isPresent: kospermindoMailbox.$container.length > 0
        });

        // Mail Container Height fit with the document
        if(kospermindoMailbox.isPresent)
        {
            kospermindoMailbox.$sidebar = kospermindoMailbox.$container.find('.mail-sidebar');
            kospermindoMailbox.$body = kospermindoMailbox.$container.find('.mail-body');


            // Checkboxes
            var $cb = kospermindoMailbox.$body.find('table thead input[type="checkbox"], table tfoot input[type="checkbox"]');

            $cb.on('click', function()
            {
                $cb.attr('checked', this.checked).trigger('change');

                mail_toggle_checkbox_status(this.checked);
            });

            // Highlight
            kospermindoMailbox.$body.find('table tbody input[type="checkbox"]').on('change', function()
            {
                $(this).closest('tr')[this.checked ? 'addClass' : 'removeClass']('highlight');
            });
        }
    });

})(jQuery, window);


function fit_mail_container_height()
{
    if(kospermindoMailbox.isPresent)
    {
        if(kospermindoMailbox.$sidebar.height() < kospermindoMailbox.$body.height())
        {
            kospermindoMailbox.$sidebar.height( kospermindoMailbox.$body.height() );
        }
        else
        {
            var old_height = kospermindoMailbox.$sidebar.height();

            kospermindoMailbox.$sidebar.height('');

            if(kospermindoMailbox.$sidebar.height() < kospermindoMailbox.$body.height())
            {
                kospermindoMailbox.$sidebar.height(old_height);
            }
        }
    }
}

function reset_mail_container_height()
{
    if(kospermindoMailbox.isPresent)
    {
        kospermindoMailbox.$sidebar.height('auto');
    }
}

function mail_toggle_checkbox_status(checked)
{
    kospermindoMailbox.$body.find('table tbody input[type="checkbox"]' + (checked ? '' : ':checked')).attr('checked',  ! checked).click();
}