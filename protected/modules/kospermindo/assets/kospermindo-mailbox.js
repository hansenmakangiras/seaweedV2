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
            kospermindoMailbox.$mailmenu = kospermindoMailbox.$sidebar.find('.mail-menu');
            kospermindoMailbox.$compose = kospermindoMailbox.$body.find('.mail-compose');

            // Auto load count message every 5 second
            // setInterval(function(){
            //     var post = $.post('/kospermindo/message/GetCountAllMessages',{});
            //     post.success(function (resp) {
            //         var data = $.parseJSON(resp);
            //         if(data){
            //             console.log(data);
            //             setTimeout(function () {
            //                 $('#menu-0').html(data.inbox);
            //                 $('#menu-1').html(data.sent);
            //                 $('#menu-2').html(data.draft);
            //                 $('#inbox').html("(" + data.inbox + ")");
            //                 $('#sent').html("(" + data.sent + ")");
            //                 $('#draft').html("("+data.draft+")");
            //             },300);
            //         }
            //     });
            //     return false;
            // },5000);

            // var selectOptions = {
            //     placeholder: "Select a state",
            //     minimumResultsForSearch: 10,
            //     allowClear : true,
            // };
            // var select = kospermindoMailbox.$compose.find('#kode_jenis_gudang');
            // var selectKelompok = kospermindoMailbox.$compose.find('#kode_kelompok');
            // var selectPetani = kospermindoMailbox.$compose.find('#petani');
            // // var kodeGudang = select.select2().val();
            // select.select2(selectOptions);
            //
            // select.on('change', function () {
            //     var kodeGudang = select.select2().val();
            //     //console.log(kodeGudang);
            //     var post = $.post('/kospermindo/message/getallkelompok',{ 'kode_jenis_gudang': kodeGudang});
            //     post.success(function (resp) {
            //         var data = $.parseJSON(resp);
            //         //console.log(data);
            //         var selectKelompokOptions = {
            //             placeholder: "Select a state",
            //             minimumResultsForSearch: Infinity,
            //             allowClear : true
            //         };
            //         selectKelompok.select2(selectKelompokOptions).val();
            //         selectKelompok.trigger('change');
            //         // console.log(selectKelompok.select2(selectKelompokOptions));
            //     });
            // });

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