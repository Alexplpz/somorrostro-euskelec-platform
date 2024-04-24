  // Mostrar modal si hay un mensaje
  if ("<?php echo $modalMessage; ?>" != "nil") {
    showModal();
}

function showModal() {
    document.getElementById("modal").style.display = "block";
}

function closeModal() {
    document.getElementById("modal").style.display = "none";
}
