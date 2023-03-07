// Controls for opening/closing new transparency file
const newFileBtn = document.getElementById("transparency-new-file");
const newFileScreen = document.getElementById("new-file-form");
const closeNewFormBtn = document.getElementById("fileformnew-close-form-btn");

newFileBtn.addEventListener("click", () => {
  newFileScreen.style.display = "block";
});

closeNewFormBtn.addEventListener("click", () => {
  newFileScreen.style.display = "none";
});

//Controls for editing transparency file

const editFileBtn = document.getElementById("edit-file-btn");
const editFileScreen = document.getElementById("edit-file-form");
const closeEditFormBtn = document.getElementById("fileformedit-close-form-btn");

editFileBtn.addEventListener("click", () => {
  editFileScreen.style.display = "block";
});

closeEditFormBtn.addEventListener("click", () => {
  editFileScreen.style.display = "none";
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
const saveOrgBtn = document.querySelector("#save-file-form");
const saveOrgScreen = document.querySelector("#success-save-org-screen");
const saveOrgOkBtn = document.querySelector("#success-save-ok-btn");

saveOrgBtn.addEventListener("click", (e) => {
  e.preventDefault();
  editFileScreen.style.display = "none";
  saveOrgScreen.style.display = "block";
});

saveOrgOkBtn.addEventListener("click", () => {
  saveOrgScreen.style.display = "none";
});
