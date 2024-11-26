const txtPassword = document.getElementById("txt-password");
const txtPasswordConfirm = document.getElementById("txt-password-confirm");
const btnActualizar = document.getElementById("btn-actualizar");

btnActualizar.addEventListener("click", async (e) => {
  e.preventDefault();

  const formData = new FormData();
  formData.append("password", txtPassword.value);
  formData.append("passwordConfirm", txtPasswordConfirm.value);

  const res = await fetch(
    "ajax_actualizar_contrasena.php", {
    method: "POST",
    body: formData,
  });
  
  const resObj = await res.json();
  
  if (resObj.success) {
    alert("Usuario actualizado exitosamente.");
  } else {
    let errores = "Errores: \n";
    resObj.errores.forEach((error) => {
      errores += `${error}\n`;
    });
    alert(errores);
  }
});
