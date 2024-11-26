const txtUsername = document.getElementById("username");
const txtName = document.getElementById("name");
const txtLastname = document.getElementById("lastname");
const txtGender = document.getElementById("gender");
const txtDateBirth = document.getElementById("date-birth");
const txtPassword = document.getElementById("password");
const txtPasswordConfirm = document.getElementById("password-confirm");
const btnEnviarRegistro = document.getElementById("btn-enviar-registro");

btnEnviarRegistro.addEventListener("submit", async (e) => {
  e.preventDefault();

  // Creamos un objeto con los datos del formulario
  const formData = new FormData();
  formData.append("username", txtUsername.value);
  formData.append("name", txtName.value);
  formData.append("lastname", txtLastname.value);
  formData.append("gender", txtGender.value);
  formData.append("date-birth", txtDateBirth.value);
  formData.append("password", txtPassword.value);
  formData.append("password-confirm", txtPasswordConfirm.value);

  const res = await fetch(`${APP_ROOT}recibe_datos_registro.php`, {
    method: "POST",
    body: formData,
  });

  const resObj = await res.json();

  if (resObj.success) {
    alert("Registro exitoso");
    window.location.href = "login.php";
  } else {
    let errores = "Errores: \n";
    resObj.errores.forEach((error) => {
      errores += `${error}\n`;
    });
    alert(errores);
    window.location.href = "login.php";
  }
});
