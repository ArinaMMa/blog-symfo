import { sendVisibilityRequest } from "./Utils/sendVisibilityRequest";

document.querySelectorAll('input[data-switch-category-id]')
    .forEach(input => { 
        input.addEventListener('change', async(e) => {
            const id = e.currentTarget.dataset.switchCategoryId;
            sendVisibilityRequest(`/admin/categories/${id}/switch`, e.target);
        })
    })