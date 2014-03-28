$(document).ready(function() {
    // Get the container that holds the collection of subforms
    var $collectionHolder = $('div.subformsCollection');

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)

    $collectionHolder.data('index', $('div.imageSubforms').find(':input').length);

    var $addSubformLink = $('a.addSubform');
    $addSubformLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();
        // add a new sub form (see next code block)
        addSubForm($collectionHolder);
    });

});

function addSubForm($collectionHolder) {
    //get subform prototype
    var prototype = $collectionHolder.data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    var $newForm = $(prototype.replace(/__name__/g, index));

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    //add subfrom to the end of the collection
    $collectionHolder.append($newForm);

    // add a delete link to the new form
    addSubFormDeleteLink($newForm);
}

function addSubFormDeleteLink($newForm) {
    //@todo remove styles
    var $removeFormA = $('<div style="margin-left: 5px;" class="grid4"><a style="text-decoration:none; border-bottom:1px dashed;" href="#">Remove</a></div><div style="clear: both;"></div>');
    $newForm.append($removeFormA);

    $removeFormA.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();
        // remove the subform
        $newForm.remove();
    });

}