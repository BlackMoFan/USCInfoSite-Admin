// Controls for editing organization
const newOrgExitBtn = document.querySelector("#neworg-close-form-btn");
const newOrgScreen = document.querySelector("#new-org-screen");
// show
const newOrgBtn = document.querySelector("#new-org-btn"); // fix this!!!!!!!!!
newOrgBtn.addEventListener("click", () => {
  newOrgScreen.style.display = "block";
});

// exit
newOrgExitBtn.addEventListener("click", () => {
  newOrgScreen.style.display = "none";
});

// Controls for editing organization
const editOrgExitBtn = document.querySelector("#editorg-close-form-btn");
const editOrgScreen = document.querySelector("#edit-org-screen");
// show
const editOrgBtn = document.querySelector(".edit-highlight"); // fix this!!!!!!!!!
editOrgBtn.addEventListener("click", () => {
  editOrgScreen.style.display = "block";
});

// exit
editOrgExitBtn.addEventListener("click", () => {
  editOrgScreen.style.display = "none";
});

// Image previewer - logo
const imageInput = document.querySelector("#org-logo");
let uploadedImage = "";

imageInput.addEventListener("change", function () {
  const reader = new FileReader();
  reader.addEventListener("load", () => {
    uploadedImage = reader.result;
    const selectedElement = document.querySelector("#org-logo-preview").style;
    selectedElement.backgroundImage = `url(${uploadedImage})`;
    selectedElement.backgroundSize = "200px 200px";
  });
  reader.readAsDataURL(this.files[0]);
});

// Image previewer - logo
const imageInputFeatured = document.querySelector("#org-featured");
let uploadedImageFeatured = "";

imageInputFeatured.addEventListener("change", function () {
  const reader = new FileReader();
  reader.addEventListener("load", () => {
    uploadedImageFeatured = reader.result;
    const selectedElement = document.querySelector(
      "#org-featured-preview"
    ).style;
    selectedElement.backgroundImage = `url(${uploadedImageFeatured})`;
    selectedElement.backgroundSize = "300px 200px";
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
const saveOrgBtn = document.querySelector("#save-org");
const saveOrgScreen = document.querySelector("#success-save-org-screen");
const saveOrgOkBtn = document.querySelector("#success-save-ok-btn");

saveOrgBtn.addEventListener("click", (e) => {
  e.preventDefault();
  editOrgScreen.style.display = "none";
  saveOrgScreen.style.display = "block";
});

saveOrgOkBtn.addEventListener("click", () => {
  saveOrgScreen.style.display = "none";
});

// Path: dist\js\organizations.js
