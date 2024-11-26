fetch("http://primosoft.com.mx/games/api/getgames.php") //Petición html
    .then(res => res.json()) //Obtener el json
    .then(games => {console.log(games);}); //hacer log, mostrar en consola