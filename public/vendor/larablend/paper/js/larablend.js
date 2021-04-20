let larablend = {
    initDateTimePicker: function() {
        if ($(".datetimepicker").length != 0) {
            $('.datetimepicker').datetimepicker({
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down",
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-screenshot',
                    clear: 'fa fa-trash',
                    close: 'fa fa-remove'
                }
            });
        }

        if ($(".datepicker").length != 0) {
            $('.datepicker').datetimepicker({
                format: 'YYYY/MM/DD',
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down",
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-screenshot',
                    clear: 'fa fa-trash',
                    close: 'fa fa-remove'
                }
            });
        }

        if ($(".timepicker").length != 0) {
            $('.timepicker').datetimepicker({
                //          format: 'H:mm',    // use this format if you want the 24hours timepicker
                format: 'h:mm A', //use this format if you want the 12hours timpiecker with AM/PM toggle
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down",
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-screenshot',
                    clear: 'fa fa-trash',
                    close: 'fa fa-remove'
                }
            });
        }
    }
}

larablend.initDateTimePicker();

let cloneable = $('.cloneable').parent().html()
let deleteCloneButton = '<div className="col-auto"><a href="#" className="btn btn-danger"><i className="fa fa-times"></i></a></div>'
$(document).ready(function (){
    // Handle Modals as AJAX
    $('.modal form').submit(function (e){
        e.preventDefault();
        let inputs = $(this).serializeArray();
        let action = $(this).attr('action')
        $.ajax({
            type: "POST",
            url: action,
            data: inputs,
            success: function(data){
                if(data.error == false){
                    let entry = data.data[0]
                    let title = entry.title || entry.name || entry.tag || entry.number || entry.first_name
                    let id = entry.id
                    let option = '<option value="'+id+'">'+title+'</option>'
                    let singular_select_id = action.split('/')[2]+'_id'
                    let plural_select_id = singular_select_id+'s'
                    let select = document.getElementById(singular_select_id) || document.getElementById(plural_select_id)
                    $(select).append(option)
                    $('.selectpicker').selectpicker('refresh');
                    $('#'+singular_select_id+'_modal').modal('hide')
                    $('#'+plural_select_id+'_modal').modal('hide')
                }
            }
        })
    })
    // Clonner
    $('.clonner button').on('click', function (e){
        e.preventDefault();
        $(e.target).parent().prev('.clone-container').append(cloneable);
        let allClones = $(e.target).parent().prev('.clone-container').children('.cloneable')
        let lastClone = allClones[allClones.length-1];
        console.log($(lastClone +" .multilevel_array_input").html())
        $('.selectpicker').selectpicker('refresh');
        larablend.initDateTimePicker();
    })
})
