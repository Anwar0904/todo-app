const dropdownArrows = document.querySelectorAll('.dropdown_arrow');
const todo_descs = document.querySelectorAll('#todo_desc');
document.querySelector('#todo_date').min=new Date().toISOString().split("T")[0];
dropdownArrows.forEach((arrow, index) => {
    arrow.onclick = function() {
        if(todo_descs[index].style.display === 'block'){
            todo_descs[index].style.display = 'none';
            arrow.style.transform = 'rotate(0deg)';
        } else {
            todo_descs[index].style.display = 'block';
            arrow.style.transform = 'rotate(180deg)';
        }
    }
});