const txtUsername = document.getElementById("searchUsername");
const txtName = document.getElementById("searchName");
const btnEnviarBusqueda = document.getElementById("searchForm");
const linkAdmin = document.getElementById("admin");
const linkReset = document.getElementById("reset");
const linkDelete = document.getElementById("delete");

btnEnviarBusqueda.addEventListener("submit", async (e) => {
  e.preventDefault();

  const searchData = {
    searchUsername: txtUsername.value,
    searchName: txtName.value,
  };

  try {
    const res = await fetch("admin_users.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(searchData),
    });

    const resObj = await res.json();

    if (resObj.success) {
      let userListTable = document
        .getElementById("userListTable")
        .getElementsByTagName("tbody")[0];
      userListTable.innerHTML = "";

      resObj.data.forEach((usuario) => {
        if (usuario.activo != '0') {
          let row = userListTable.insertRow();

          row.innerHTML = `
          <td>${usuario.username}</td>
          <td>${usuario.nombre}</td>
          <td>${usuario.apellidos}</td>
          <td>${usuario.genero}</td>
          <td>${usuario.fecha_nacimiento}</td>
          <td>${usuario.es_admin}</td>
          <td>
            ${
              usuario.es_admin != "1"
                ? `<a href="users_admin.php?username=${usuario.username}">Hacer Admin</a> |`
                : ""
            }
            <a href="reset_password.php?username=${
              usuario.username
            }">Resetear Contraseña</a> |
            <a href="delete_user.php?username=${
              usuario.username
            }">Eliminar Usuario</a>
          </td>
        `;
        }
      });
    } else {
      let errores = "Errores: \n";
      resObj.errores.forEach((error) => {
        errores += `${error}\n`;
      });
      alert(errores);
    }
  } catch (error) {
    console.error("Error al realizar la solicitud:", error);
    alert("Ocurrió un error al realizar la búsqueda.");
  }
});
