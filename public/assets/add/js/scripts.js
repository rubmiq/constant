function getCategories() {
    $.ajax({
        url: '/api/getCategories',
        method: 'GET',
        success: function (data) {
            var response = JSON.parse(data);
            $('.main').html('');
            $('#add_parent_id').html(' <option value="0">Main</option>');
            var tmp_content = child(response);
            $('.main').append('<ul class="main_sort">'+tmp_content+'</ul>');   
            sort();
            $('.editable').click(function() {
                show_edit_modal($(this).attr('sub_id'));
            })
        }
    });
}

function child(value) {
    var content = '';

    value.forEach(element => {
        if(element.childs.length > 0){
            // alert(value[id].childs.length);
            var text = child(element.childs);
            content += '<li class="editable" id="sub_'+element.id+'" sub_id="'+element.id+'"><span>' + element.name_arm + '</span><ul parent_id="'+element.id+'" class="sort">' + text + "</ul></li>"
            $('#add_parent_id').append('<option value="'+element.id+'">'+element.name_arm+'</option>')
        }else{
            content += '<li class="editable" id="sub_'+element.id+'" sub_id="'+element.id+'"><span>' + element.name_arm + '</span><ul parent_id="'+element.id+'" class="sort"></ul></li>'
            $('#add_parent_id').append('<option value="'+element.id+'">'+element.name_arm+'</option>')
        }
    });
    return content;
}

function add_category() {
    var data = {
        name_arm: $('#name_arm').val(),
        name_rus: $('#name_rus').val(),
        name_eng: $('#name_eng').val(),
        parent_id: $('#add_parent_id').val(),
    };

    $.ajax({
        url: '/api/addCategories',
        method: 'POST',
        data: data,
        success: function (response) {
            getCategories();
            $('#add_modal').modal('hide');
        }
    });
}

function edit_category() {
    var data = {
        name_arm: $('#edit_name_arm').val(),
        name_rus: $('#edit_name_rus').val(),
        name_eng: $('#edit_name_eng').val(),
        id: $('#edit_id').val(),
    };

    $.ajax({
        url: '/api/updateCategory',
        method: 'PUT',
        data: data,
        success: function (response) {
            getCategories();
            $('#edit_modal').modal('hide');
        }
    });
}


function sort() {
    $(".sort").sortable({
        connectWith: ".sort",
        stop: function (event, ui) {
            var id = ui.item.attr("id");
            var parent_id = $('#' + id).parent().attr('parent_id');
            var positions = {};
            var y = 0;
            $('#' + id).parent().children('li').each(function () {
               positions[y] = $(this).attr('sub_id');
               y++; 
            });

            console.log(positions);
            send_sort(positions, parent_id);
        }
    }).disableSelection();

    $(".main_sort").sortable({
        stop: function (event, ui) {
            var id = ui.item.attr("id");
            var positions = {};
            var y = 0;
            $('#' + id).parent().children('li').each(function () {
               positions[y] = $(this).attr('sub_id');
               y++; 
            });
            send_main_sort(positions);
        }
    }).disableSelection();
};

function send_sort(positions, parent_id) {
    var data = {
        positions: positions,
        parent_id: parent_id
    };
    $.ajax({
        url: '/api/set_sort',
        method: 'PUT',
        data: data,
        success: function (response) {
            console.log(response);
            // getCategories();

        }
    });
}

function send_main_sort(positions) {
    var data = {
        positions: positions,
    };
    $.ajax({
        url: '/api/set_main_sort',
        method: 'PUT',
        data: data,
        success: function (response) {
            console.log(response);
            // getCategories();

        }
    });
}
getCategories();

function show_edit_modal(id) {
    $.ajax({
        url: '/api/edit/' + id,
        method: 'GET',
        success: function (response) {
            var data = JSON.parse(response);
            $('#edit_name_arm').val(data[0].name_arm);
            $('#edit_name_rus').val(data[0].name_rus);
            $('#edit_name_eng').val(data[0].name_eng);
            $('#edit_id').val(data[0].id)
            $('#edit_modal').modal('show');

        }
    });
};