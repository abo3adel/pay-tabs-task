import './bootstrap';

import Alpine from 'alpinejs';

import $ from "jquery";

// const element = document.querySelector('#category_id');
// import Choices from '../../node_modules/choices.js/public/assets/scripts/choices.min.js';
// const choices = new Choices(element);

window.Alpine = Alpine;

Alpine.start();

$(document).ready(function() {
    let latestLevel = 1;
    $(document).on('change', '.select', async function(ev) {
        // alert('Alpine is ready');

        const val = $(this).val();
        
        const res = await axios.get('sub-categories/' + val);

        if (!res || !res.data) {
            alert('error');
            return;
        }

        if (!res.data.sub_categories.length) return;

        const categories = res.data.sub_categories;
        if (categories[0].level > latestLevel) {
            latestLevel = categories[0].level;
            // create new select menu for new data
            let code = `
                <div class="py-4">
                    <select class="select bg-gray-700 text-white" name="category_id2" id="category_id2" >`;
                        for (let category of categories) {
                            code += `<option value="${category.id}">${category.name}</option>`;
                        }
                   code += `</select>
                </div>
            `;

            $('#sub-categories').append(code);
        }
    });
});