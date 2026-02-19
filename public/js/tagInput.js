document.addEventListener('DOMContentLoaded', function(){
   
     let selectedTags = [];

         
        const tagInput = document.getElementById('tag-input');
        const suggestionBox = document.querySelector('.tag-suggestions');
        const selectedTagsContainer = document.querySelector('.selected-tags');
       
       
        tagInput.addEventListener('keyup', function(e){
            console.log('called');
              const query = this.value.trim();

              if(!query){
                 suggestionBox.innerHTML = '';
                 suggestionBox.style.display = 'none';
                 return;
              }

              fetch(`/tags/search?q=${query}`)
              .then(res=> res.json())
              .then(data => renderSuggestions(data, query));
        })

        function renderSuggestions(tags, query){
             suggestionBox.innerHTML = '';
             suggestionBox.classList.add('list-group');
             suggestionBox.style.display = 'block';

             tags.forEach(tag => {
                   const div = document.createElement('div');
                   div.classList.add('list-group-item', 'list-group-item-action', 'suggestion');
                   div.textContent = tag.name;
                   div.addEventListener('click', () => addTag(tag.name));
                   suggestionBox.appendChild(div);
             });

             if(!tags.some(t => t.name.toLowerCase() === query.toLowerCase())){
                 const div = document.createElement('div');
                  div.classList.add('list-group-item', 'list-group-item-action', 'suggestion', 'fw-bold');
                 div.textContent = `"${query}"`;
                 div.addEventListener('click', () => addTag(query));
                 suggestionBox.appendChild(div);
             }
        }


    // ----- Add tag -----
    function addTag(tagName) {
        tagName = tagName.trim();
        if (!tagName || selectedTags.includes(tagName)) return;

        selectedTags.push(tagName);
        tagInput.value = '';
        suggestionBox.innerHTML = '';
        suggestionBox.style.display = 'none';
        renderSelectedTags();
    }

    // ----- Render selected tags -----
    function renderSelectedTags() {
        selectedTagsContainer.innerHTML = '';

        selectedTags.forEach(tag => {
            const span = document.createElement('span');
            span.classList.add('badge', 'bg-primary', 'tag-badge');
            span.textContent = tag;

            // remove button
            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.textContent = '×';
            removeBtn.addEventListener('click', () => removeTag(tag));
            span.appendChild(removeBtn);

            selectedTagsContainer.appendChild(span);

            // hidden input for form submission
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'tags[]';
            hiddenInput.value = tag;
            selectedTagsContainer.appendChild(hiddenInput);
        });
    }

    // ----- Remove tag -----
    function removeTag(tagName) {
        selectedTags = selectedTags.filter(t => t !== tagName);
        renderSelectedTags();
    }
});