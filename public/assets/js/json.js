$(function () {
    $(document).bind("contextmenu", function (e) {
        return false;
    });

    $('#json_editor').html('');
    json_editor('json_editor', '{"key":"text"}');

    // add the jquery editing magic
    apply_editlets();
});

// stuff for the modal ws window
function display_ws_modal() {
    var id = '#dialog';
    //transition effect
    $('#mask').fadeIn(500);
    $('#mask').fadeTo("slow", 0.8);

    //Get the window height and width
    var winH = $(window).height();
    var winW = $(window).width();

    //Set the popup window to center
    $(id).css('top', winH / 2 - $(id).height() / 2);
    $(id).css('left', winW / 2 - $(id).width() / 2);

    //transition effect
    $(id).fadeIn(1000);
}

// stuff for the right click menus
function setup_menu() {
    $('div[data-role="arrayitem"]').contextMenu('context-menu1', {
        'remove item': {
            click: remove_item,
            klass: "menu-item-1" // a custom css class for this menu item (usable for styling)
        },
    }, menu_options);
    $('div[data-role="prop"]').contextMenu('context-menu2', {
        'remove item': {
            click: remove_item,
            klass: "menu-item-1" // a custom css class for this menu item (usable for styling)
        },
    }, menu_options);
}
function remove_item(element) {
    console.log("# delete");
    element.hide(500, function () {
        $(this).remove();
    });
}
function create_item(element) {
    console.log("# create");
}
var menu_options = {
    disable_native_context_menu: true,
    showMenu: function (element) {
        element.addClass('dimmed');
    },
    hideMenu: function (element) {
        element.removeClass('dimmed');
    },
};

var easy_save_value = function (value, settings) {
    $(this).text(value);
}
var save_value = function (value, settings) {
    $(this).text(value);
};
// copy the workspace back into the textarea
function extract_json(divid, indent) {
    $('#json-schema').val(glean_json(divid, indent));
}
// convert the work area to a json string
function glean_json(divid, indent) {
    var base = $('#' + divid);
    var rootnode = base.children('div[data-role="value"]:first');
    var jsObject = parse_node(rootnode);
    var json = JSON.stringify(jsObject, null, indent);
    return json;
}
// convert the work area to a js object
function parse_node(node) {
    var type = node.data('type');
    if (type == 'object') {
        var newNode = new Object();
        var props = node.children('div[data-role="prop"]');
        props.each(function (index) {
            newNode[$(this).children('[data-role="key"]').html()] = parse_node($(this).children('[data-role="value"]'));
        });
        return newNode;
    } else if (type == 'array') {
        var newNode = new Array();
        var values = node.children('[data-role="arrayitem"]');
        values.each(function (index) {
            var value_node = $(this).children('[data-role="value"]');
            newNode.push(parse_node(value_node));
        });
        return newNode;
    } else if (type == 'string') {
        return node.html();
    } else {
        return "(Unknown Type:" + type + " )";
    }
}
function remove_editlets() {
    $("span.collapse_box").remove();
    $("div.inline_add_box").remove();
    $(".context-menu").remove();

}
function apply_editlets() {
    remove_editlets();
    // add collapse boxes for the arrays and objects
    var o_collapse_box = $('<span class="collapse_box"><span>[-]</span><span style="display: none">[+] {...}</span></span>');
    var a_collapse_box = $('<span class="collapse_box"><span>[-]</span><span style="display: none" data-role="counter">[+] []</span></span>');
    $('div[data-type="object"]').before(o_collapse_box);
    $('div[data-type="array"]').before(a_collapse_box);

    $('.collapse_box').click(function () {
        var next = $(this).next();
        next.toggle();
        $(this).find('span').toggle();
        if (next.data('type') == 'array') {
            $(this).find('span[data-role="counter"]').html('[+] [' + next.children('[data-role="arrayitem"]').length + ']');
        }
        event.stopPropagation();
    });

    // add the "new" buttons
    var add_more_box = $('<div class="inline_add_box"><span class="add_box_icon">+</span><div class="add_box_content">add: <a data-task="add_value" href="#">text</a> | <a data-task="add_array" href="#">array</a> | <a data-task="add_object" href="#">object</a></div></div>');
    $('div[data-type="object"]').append(add_more_box);
    $('div[data-type="array"]').append(add_more_box);

    $('div.inline_add_box a').click(function (e) {
        var target = $(e.target);
        var task = target.data('task');
        var add_box = target.parents(".inline_add_box");
        var collection = add_box.parent();
        var type = collection.data('type');

        // TODO this code is a partial duplicate of code in make_node fix it!
        if (type == 'object') {
            var newObj = $('<div data-role="prop"></div>').append($('<span data-role="key">').append("key")).append(': ');
        } else {
            var newObj = $('<div data-role="arrayitem"></div>');
        }

        if (task == 'add_object') {
            var json = '{"key":"text"}';
            newObj.append(make_node(JSON.parse(json)));
        } else if (task == 'add_array') {
            var json = '["text"]';
            newObj.append(make_node(JSON.parse(json)));
        } else {
            newObj.append($('<pre data-role="value" data-type="string">').html("text"));
        }
        newObj.hide();
        add_box.before(newObj);
        newObj.show(500);
        apply_editlets();
        return false;
    });

    $(".inline_add_box").hover(
        function () {
            $(this).children().show();
            $(this).find('.add_box_icon').hide();
        },
        function () {
            $(this).children().hide();
            $(this).find('.add_box_icon').show();
        }
    );

    // make the fields editable in place
    $('span[data-role="key"]').editable(easy_save_value, { cssclass: 'edit_box', height: '20px', width: '100px', placeholder: 'null' });
    $('[data-type="string"]').editable(save_value, {
        data: '{"text":"text","textarea":"textarea","number":"number"}',
        type: 'select',
        cssclass: 'edit_box',
        height: '20px',
        width: '150px',
        placeholder: 'null',
        onblur: 'submit'
    });

    // make the right click menus
    setup_menu();

}

// parse the text area into the the workarea, setup the event handlers
function load_from_box() {
    $('#json_editor').html('');
    json_editor('json_editor', $('#json-schema').val());

    // add the jquery editing magic
    apply_editlets();
}
// convert a string into nodes
function json_editor(divid, json_string) {
    try {
        var json = JSON.parse(json_string);
    } catch (err) {
        var json = JSON.parse('{"error": "parse failed"}');
    }
    var base = $('#' + divid);
    base.append(make_node(json));
}
// recursively make html nodes out of the json
function make_node(node_in) {
    console.log(" ====> " + JSON.stringify(node_in));
    var type = Object.prototype.toString.apply(node_in);
    console.log("  - " + type);

    if (type === "[object Object]") {
        // TODO create the div for an object here
        var container = $('<div data-role="value" data-type="object"></div>');
        for (var prop in node_in) {
            if (node_in.hasOwnProperty(prop)) {
                var row = $('<div data-role="prop"></div>').append($('<span data-role="key">').append(prop)).append(': ').append(make_node(node_in[prop]));
                container.append(row);
            }
        }
        return container;
    } else if (type === "[object Array]") {
        var container = $('<div data-role="value" data-type="array"></div>');
        for (var i = 0, j = node_in.length; i < j; i++) {
            var row = $('<div data-role="arrayitem"></div>').append(make_node(node_in[i]));
            container.append(row);
        }
        return container;
    } else if (type === "[object String]") {
        return $('<pre data-role="value" data-type="string">').html(node_in);
    }
}
