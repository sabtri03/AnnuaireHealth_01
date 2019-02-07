// setup an "add a tag" link
var $addLogoButton = $('<button type="button" class="add_logo_link">Add a tag</button>');
var $newLinkLi = $('<li></li>').append($addLogoButton);

jQuery(document).ready(function($) {

    // Get the ul that holds the collection of logos
    var $collectionHolder = $('ul.logos');

    // add the "add a tag" anchor and li to the logos ul
    $collectionHolder.append($newLinkLi);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addLogoButton.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();
        console.log('click click');
        // add a new tag form (see code block below)
        addLogoForm($collectionHolder, $newLinkLi);
    });


});

function addLogoForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    // Replace '$$name$$' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormLi = $('<li></li>').append(newForm);

    // also add a remove button, just for this example
    $newFormLi.append('<a href="#" class="remove-logo">x</a>');

    $newLinkLi.before($newFormLi);

    // handle the removal, just for this example
    $('.remove-logo').click(function(e) {
        e.preventDefault();

        $(this).parent().remove();

        return false;
    });
}