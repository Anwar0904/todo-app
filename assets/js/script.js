const dropdownArrow = document.querySelector('.dropdown_arrow');
const todo_desc = document.querySelector('#todo_desc');

dropdownArrow.onclick = function() {

    if(todo_desc.style.display === 'block'){
        todo_desc.style.display = 'none';
        dropdownArrow.style.transform = 'rotate(0deg)';
    } else {
        todo_desc.style.display = 'block';
        dropdownArrow.style.transform = 'rotate(180deg)';
    }
}