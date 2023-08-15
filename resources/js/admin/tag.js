import Tagify from '@yaireo/tagify'

var inputElm = document.querySelector('#email');
let users;

function tagTemplate(tagData) {
    return `
        <tag
                contenteditable="false"
                spellcheck="false"
                tabIndex="-1"
                class="tagify__tag ${tagData.class ? tagData.class : ''}"
                ${this.getAttributes(tagData)}>
            <x title="" class="tagify__tag__removeBtn" role="button" aria-label="remove tag"></x>
            <div>
                <span class="tagify__tag-text">${tagData.name}</span>
            </div>
        </tag>
    `
}

function suggestionItemTemplate(tagData) {
    return `
        <div ${this.getAttributes(tagData)}
            class="tagify__dropdown__item ${tagData.class ? tagData.class : ''}"
            tabindex="0"
            role="option">
            <strong>${tagData.name}</strong>
            <span>${tagData.email}</span>
        </div>
    `
}

function dropdownHeaderTemplate(suggestions){
    return `
        <header data-selector='tagify-suggestions-header' class="${this.settings.classNames.dropdownItem} ${this.settings.classNames.dropdownItem}__addAll">
            <div>
                <strong>${this.value.length ? `Add Remaning` : 'Add All'}</strong>
                <a class='remove-all-tags'>Remove all</a>
            </div>
            <span>${suggestions.length} members</span>
        </header>
    `
}

let tagify = new Tagify(inputElm, {
    originalInputValueFormat: (valuesArr) => valuesArr.map((item) => item.email),
    tagTextProp: 'name',
    skipInvalid: true,
    enforceWhitelist: true,
    dropdown: {
        closeOnSelect: false,
        enabled: 0,
        classname: 'users-list',
        searchKeys: ['name', 'email'],
    },
    templates: {
        tag: tagTemplate,
        dropdownItem: suggestionItemTemplate,
        dropdownHeader: dropdownHeaderTemplate
    },
    whitelist: [],
})

tagify.on('dropdown:select', onSelectSuggestion)
function onSelectSuggestion(e){
    if( e.detail.event.target.matches('.remove-all-tags')) {
        tagify.removeAllTags()
    }

    // custom class from "dropdownHeaderTemplate"
    else if( e.detail.elm.classList.contains(`${tagify.settings.classNames.dropdownItem}__addAll`) )
        tagify.dropdown.selectAll();
}

$('#title').change(function () {
    let url = $('#url_email').data('tagify');
    let data = {
        course_id: this.value,
    };

    $.ajax({
        type: "GET",
        url: url,
        data: data,
        dataType: "json",
        success: function (response) {
            tagify.whitelist = response.data;
        }
    });
});

