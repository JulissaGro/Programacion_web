document.querySelectorAll('.btn-borrar-archivo').forEach(btn => {
    btn.addEventListener('click', async (e) => {
        e.preventDefault();

        const archivoId = btn.closest('tr').querySelector('.id-archivo').textContent.trim();
        console.log(archivoId);

        const datos = new FormData();
        datos.append('archivo', archivoId);

        const res = await fetch(`${APP_ROOT}ajax/borrar_archivo.php`, {
            method: "POST",
            body: datos
        });

        const resObj = await res.json();

        if (resObj.error) {
            alert(resObj.error);
        }
        if (resObj.mensaje) {
            alert(resObj.mensaje);
            location.reload();
        }
    });
});

document.querySelectorAll('.btn-hacer-publico').forEach(btn => {
    btn.addEventListener('click', async (e) => {
        e.preventDefault();

        const archivoId = btn.closest('tr').querySelector('.id-archivo').textContent.trim();
        console.log(archivoId);

        const datos = new FormData();
        datos.append('archivo', archivoId);

        const res = await fetch(`${APP_ROOT}ajax/hacer_publico.php`, {
            method: "POST",
            body: datos
        });

        const resObj = await res.json();

        if (resObj.error) {
            alert(resObj.error);
        }
        if (resObj.mensaje) {
            alert(resObj.mensaje);
            location.reload();
        }
    });
});

document.querySelectorAll('.btn-hacer-privado').forEach(btn => {
    btn.addEventListener('click', async (e) => {
        e.preventDefault();

        const archivoId = btn.closest('tr').querySelector('.id-archivo').textContent.trim();

        const datos = new FormData();
        datos.append('archivo', archivoId);

        const res = await fetch(`${APP_ROOT}ajax/hacer_privado.php`, {
            method: "POST",
            body: datos
        });

        const resObj = await res.json();

        if (resObj.error) {
            alert(resObj.error);
        }
        if (resObj.mensaje) {
            alert(resObj.mensaje);
            location.reload();
        }
    });
});
