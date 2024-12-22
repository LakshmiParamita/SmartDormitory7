<style>
.container {
    max-width: 1500px;
    margin: 0 auto;
    padding: 20px;
    justify-content: center;
}

.title{
    font-family: "Montserrat-SemiBold", Helvetica;
    font-size: 96px;
}

.logout{
    font-size: 24px;
}

.features {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-gap: 30px;
    }

.feature {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    background-color: #fff;
    border-radius: 15px;
    padding: 30px 20px;
    text-align: center;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.feature img {
    max-width: 80px;
    height: 80px;
}

a:link, a:visited {
  text-decoration: none;
  font-family: "Montserrat-SemiBold", Helvetica;
  color: black;
  font-size: 20px;
  margin-top: 15px;
}

a:hover, a:active {
  color: black;
}

.header {
    background-color: #fff;
    border-radius: 0 0 20px 20px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    margin-bottom: 30px;
    width: 100%;
}

.logo {
  max-width: 60px;
  height: auto;
}

.title {
  font-size: 28px;
  font-weight: bold;
}
</style>

<!DOCTYPE html>
<html>
  <head>
  <title>SmartDorm</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light"> 
    <div class="header">
    <img class="logo" src="images/dorm_logo.png" />   
            <h1 class="title">SmartDorm</h1>
            <h2 class="logout">Logout</h2>
            </div>
            </nav>
        </div>
        <div class="homescreen">
    <div class="features">
          <div class="feature">
            <img class="icon" src="images/lock.png" />
            <a href="{{ route('water.index') }}" class="feature-title">Smart Lock</a>
          </div>
          <div class="feature">
            <img class="icon" src="images/lighting.png" />
            <a href="{{ route('water.index') }}" class="feature-title">Smart Lighting</a>
          </div>
          <div class="feature">
            <img class="icon" src="images/cctv.png" />
            <a href="{{ route('water.index') }}" class="feature-title">Smart CCTV</a>
          </div>
          <div class="feature">
            <img class="icon" src="images/air.png" />
            <a href="{{ route('water.index') }}" class="feature-title">Monitoring Air</a>
          </div>
          <div class="feature">
            <img class="icon" src="images/gedung.png" />
            <a href="{{ route('water.index') }}" class="feature-title">Pengelolaan Gedung</a>
          </div>
          <div class="feature">
            <img class="icon" src="images/error.png" />
            <a href="{{ route('water.index') }}" class="feature-title">Laporan Error</a>
          </div>
        </div>
      </div>
  </body>
</html>