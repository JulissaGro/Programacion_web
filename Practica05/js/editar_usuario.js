const txtUsername = document.getElementById("txt-username");
const txtName = document.getElementById("txt-name");
const txtLastname = document.getElementById("txt-lastname");
const txtGender = document.getElementById("txt-gender");
const txtDateBirth = document.getElementById("txt-date-birth");
const btnEnviarRegistro = document.getElementById("btn-enviar-registro");

btnEnviarRegistro.addEventListener("click", async (e) => {
  e.preventDefault();

  const formData = new FormData();
  formData.append("username", txtUsername.value);
  formData.append("name", txtName.value);
  formData.append("lastname", txtLastname.value);
  formData.append("gender", txtGender.value);
  formData.append("date-birth", txtDateBirth.value);

  const res = await fetch("editar_usuario.php", {
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
