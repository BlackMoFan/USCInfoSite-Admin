// Controls for adding new officer
const newUscOfficerScreen = document.getElementById("new-usc-officer-screen");
const exitNewUscForm = document.getElementById("newusc-close-form-btn");

exitNewUscForm.addEventListener("click", () => {
  newUscOfficerScreen.style.display = "none";
});

const newUscBtn = document.getElementById("new-usc-btn");
newUscBtn.addEventListener("click", () => {
  newUscOfficerScreen.style.display = "block";
});

// Controls for editing existing officer
const editUscOfficerScreen = document.getElementById("edit-usc-officer-screen");
const exitEditUscForm = document.getElementById("editusc-close-form-btn");
exitEditUscForm.addEventListener("click", () => {
  editUscOfficerScreen.style.display = "none";
});

const editUscOfficerBtn = document.querySelector(".edit-highlight");
editUscOfficerBtn.addEventListener("click", () => {
  editUscOfficerScreen.style.display = "block";
});

// Image previewer (new officer)
const newImageInput = document.querySelector("#new-officer-image");
let uploadedImage = "";

newImageInput.addEventListener("change", function () {
  const reader = new FileReader();
  reader.addEventListener("load", () => {
    uploadedImage = reader.result;
    const selectedElement = document.querySelector(
      "#new-officer-image-preview"
    ).style;
    selectedElement.backgroundImage = `url(${uploadedImage})`;
    selectedElement.backgroundSize = "250px 250px";
  });
  reader.readAsDataURL(this.files[0]);
});

// Image previewer (new officer)
const editImageInput = document.querySelector("#edit-officer-image");
editImageInput.addEventListener("change", function () {
  const reader = new FileReader();
  reader.addEventListener("load", () => {
    uploadedImage = reader.result;
    const selectedElement = document.querySelector(
      "#edit-officer-image-preview"
    ).style;
    selectedElement.backgroundImage = `url(${uploadedImage})`;
    selectedElement.backgroundSize = "250px 250px";
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
const saveOrgBtn = document.querySelector("#save-uscofficer");
const saveOrgScreen = document.querySelector("#success-save-org-screen");
const saveOrgOkBtn = document.querySelector("#success-save-ok-btn");

saveOrgBtn.addEventListener("click", (e) => {
  e.preventDefault();
  editUscOfficerScreen.style.display = "none";
  saveOrgScreen.style.display = "block";
});

saveOrgOkBtn.addEventListener("click", () => {
  saveOrgScreen.style.display = "none";
});
