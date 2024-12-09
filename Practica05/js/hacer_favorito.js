document.querySelectorAll('.btn-favorito').forEach(btn => {
    btn.addEventListener('click', async (e) => {
        e.preventDefault();

        const archivoId = btn.closest('tr').querySelector('.id-archivo').textContent.trim();
        console.log(archivoId);

        const datos = new FormData();
        datos.append('archivo', archivoId);

        const res = await fetch(`${APP_ROOT}ajax/hacer_favorito.php`, {
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

document.querySelectorAll('.btn-desfavorito').forEach(btn => {
    btn.addEventListener('click', async (e) => {
        e.preventDefault();

        const archivoId = btn.closest('tr').querySelector('.id-archivo').textContent.trim();
        console.log(archivoId);

        const datos = new FormData();
        datos.append('archivo', archivoId);

        const res = await fetch(`${APP_ROOT}ajax/quitar_favorito.php`, {
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