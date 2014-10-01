// setup an "add a tag" link
var $addItemLink = $('<td><a href="#" class="add_tag_link">Add an Item</a></td>');
var $newLinkRow = $('<tr><td></td><td></td></tr>').append($addItemLink);

jQuery(document).ready(function() {
    // Get the ul that holds the collection of tags
    var $collectionHolder = $('table');

    $collectionHolder.find('tr.item').each(function() {
        addItemFormDeleteLink($(this));
    });

    // add the "add a tag" anchor and li to the tags ul
    $collectionHolder.append($newLinkRow);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addItemLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see code block below)
        addItemForm($collectionHolder, $newLinkRow);
    });


});

function addItemForm($collectionHolder, $newLinkLi) {
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
    var $newFormRow = $('<tr></tr>').append(newForm);

    addItemFormDeleteLink($newFormRow);

    $newLinkRow.before($newFormRow);
}

function addItemFormDeleteLink($tagFormRow) {
    var $removeFormA = $('<td><a href="#">Remove this Item</a></td>');
    $tagFormRow.append($removeFormA);

    $removeFormA.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // remove the li for the tag form
        $tagFormRow.remove();
    });
}