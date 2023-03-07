// Controls for "Add new highlight"
const newArticleScreen = document.getElementById("new-article-screen");
const exitForm = document.getElementById("newarticle-close-form-btn");
exitForm.addEventListener("click", () => {
  newArticleScreen.style.display = "none";
});

const newArticleBtn = document.getElementById("new-article-btn");
newArticleBtn.addEventListener("click", () => {
  newArticleScreen.style.display = "block";
});

// Controls for editing highlight
const editHighlightBtn = document.querySelector(".edit-highlight"); // to be improved!
const editHighlightScreen = document.querySelector("#edit-article-screen");
editHighlightBtn.addEventListener("click", () => {
  editHighlightScreen.style.display = "block";
});

const exitEditForm = document.getElementById("editarticle-close-form-btn");
exitEditForm.addEventListener("click", () => {
  editHighlightScreen.style.display = "none";
});

// Image previewer
const imageInput = document.querySelector("#featured-image");
let uploadedImage = "";

imageInput.addEventListener("change", function () {
  const reader = new FileReader();
  reader.addEventListener("load", () => {
    uploadedImage = reader.result;
    const selectedElement = document.querySelector(
      "#featured-image-preview"
    ).style;
    selectedElement.backgroundImage = `url(${uploadedImage})`;
    selectedElement.backgroundSize = "300px 225px";
  });
  reader.readAsDataURL(this.files[0]);
});

// Delete organization event listener
const confirmDeleteOrgScreen = document.querySelector(
  "#confirm-delete-org-screen"
);
const cancelDeleteOrgBtn = document.querySelector("#cancel-delete-btn");

const deleteOrgBtn = document.querySelector("#delete-article-btn");
deleteOrgBtn.addEventListener("click", () => {
  confirmDeleteOrgScreen.style.display = "block";
});

// Successfully deleted org screen declarations
const successDeleteOrgScreen = document.querySelector(
  "#success-delete-org-screen"
);
const successDeleteOkBtn = document.querySelector("#success-delete-ok-btn");

// Delete organization event listener

const confirmDeleteBtn = document.querySelector("#confirm-delete-btn");
confirmDeleteBtn.addEventListener("click", () => {
  confirmDeleteOrgScreen.style.display = "none";
  successDeleteOrgScreen.style.display = "block";
});

cancelDeleteOrgBtn.addEventListener("click", () => {
  confirmDeleteOrgScreen.style.display = "none";
});

successDeleteOkBtn.addEventListener("click", () => {
  successDeleteOrgScreen.style.display = "none";
});

// save org screen event listener
const saveOrgBtn = document.querySelector("#save-article");
const saveOrgScreen = document.querySelector("#success-save-org-screen");
const saveOrgOkBtn = document.querySelector("#success-save-ok-btn");

saveOrgBtn.addEventListener("click", (e) => {
  e.preventDefault();
  editHighlightScreen.style.display = "none";
  saveOrgScreen.style.display = "block";
});

saveOrgOkBtn.addEventListener("click", () => {
  saveOrgScreen.style.display = "none";
});
