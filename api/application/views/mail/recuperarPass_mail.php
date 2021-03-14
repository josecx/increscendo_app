<div style="padding: 30px; text-align: center; font-family: 'Helvetica', 'sans-serif'; color: #424242; font-size: 16px; background: rgba(22,58,107,0.6);
">
  <div style="text-align: left; width: 600px; max-width: 100%; margin: 0 auto;">
    <div style="margin-bottom: 20px">
      <img src="https://drive.google.com/uc?export=view&id=1mgGskKI-iadVYxf9aRDiZ8Xsuxg41C-c" alt="" style="max-height: 65px; margin-left: 40px">
    </div>
    <div style="background-color: #fff; padding: 25px 40px 50px; margin: 20px 0 40px; box-shadow: 0 0 25px rgba(26, 108, 225, 0.1); border-radius: 4px">
      <h2 text-transform: uppercase; padding: 30px 20px 10px 0; font-size: 1.25rem; margin: 0"></h2>
      <span style="display: block; height: 4px; width: 100%; margin-top: 5px;"></span>
      <h3 style="color: #222">¡Hola <?=$usuario->nombre;?>!</h3>
      <p style=" margin-bottom: 10px">Parece que has olvidado tu contraseña, ¡no te preocupes! te hemos generado una nueva para que puedas ingresar a la aplicación :D</p>
      <img src="{{ $link.'/'.$career->Theme->Image }}" alt="" style="max-width: 100%; margin-bottom: 30px; border-radius: 4px;">
      <p style="background-color: #F39002 !important; border-color: #F39002 !important; color: white; padding: 10px 30px; text-decoration: none; border-radius: 4px; text-align: center;">Contraseña: <?=$password;?> </p>
    </div>
  </div>
</div>