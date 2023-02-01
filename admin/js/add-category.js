let addSubCat = document.getElementById("addSubCat");
var i = 1;
var cat = 1;

addSubCat.onclick = () => {
    let subCategoryContainer = document.getElementById("subCategory");
    if(i > 5) return;
    subCategoryContainer.innerHTML += `<div class="form-control">
    <div class="input-group">
        <input type="text" name="category${cat}" placeholder="Sub-Category Name" class="input input-bordered w-full">
        <div class="btn btn-square btn-error text-white" onclick="deleteInput(this)">X</div>
    </div>
</div>`;
    cat++;
    i++;
}

const deleteInput = (btn) => {
    btn.parentElement.parentElement.remove();
    i--;
}