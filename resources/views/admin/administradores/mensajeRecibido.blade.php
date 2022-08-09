<div class="container">
    <div class="wrapper">
        <div class="title"><span>BIENVENIDO!</span>
        <h5>{{$msg['Nombre']}}</h5>
        </div>
            <div class="card-body">
                <p>Gracias por trabajar con nosotros, el equipo de ADS Sports
                  te da la bienvenida y te desea lo mejor.
                </p>
                <p>
                  Tu Rol es:
                </p>
                <div class="line"></div>
                <p>
                <strong>{{$msg['Rol']}}</strong>
                </p>
                <div class="line"></div>
                <p>Debajo puedes encontrar tu contraseña temporal: </p>
                <p><div class="card-password"><strong>
                    {{$msg['Password']}}
                </strong></div></p>
                <div class="line"></div>
                <p>Tu cuenta es válida hasta: <strong>{{$msg['Fecha']}}</strong></p>
            </div>
    </div>
</div>
<style>
/* Reseting */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins',sans-serif;
}
body{
  background: #202A44;
  overflow: hidden;
}
.container{
  max-width: 340px;
  margin: auto;   

}
.wrapper{
  width: 100%;
  background: #fff;
  border-radius: 5px;
  box-shadow: 0px 0px 10px 10px rgba(0,0,0,0.1);
  height: 100%;
}
p{
    margin-top: 20px;
    margin-bottom: 20px;
}
.wrapper .title{
  height: 90px;
  background: #003959;
  border-radius: 5px 5px 0 0;
  color: #fff;
  font-size: 30px;
  font-weight: 600;
  display: block;
  align-items: center;
  justify-content: center;
  text-align: center;
}
.card-body{
    padding: 10;
    text-align: center;    
}
.card-password{
    background-color: #999;
    color: white;
    text-align: center;
    padding: 10;
    border-radius: 5px;
    font-size: 25px;
}
.line{
    margin: 10px;
    height: 1px;
  background-color: gray;
}

h5{
    font-size: 15px;
}
</style>



