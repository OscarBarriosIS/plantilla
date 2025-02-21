<style>
    /* Navbar styles */
    .navbar {
        background: #29ABE2;
        /* Darker gradient to the right */
        padding: 10px 10px 10px 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: fixed;
        top: 0;
        width: 100%;
        transition: width 0.3s ease, left 0.3s ease;
        z-index: 999;
    }

    .navbar-left {
        font-weight: bold;
        color: #333;
    }

    .navbar-right {
        display: flex;
        align-items: center;
        margin-right: 10px;
    }

    .button {
        background-color: #ffffff;
        color: rgb(0, 0, 0);
        padding: 8px 12px;
        border: none;
        border-radius: 20px;
        margin-left: 10px;
        margin-right: 10px;
        cursor: pointer;
    }
</style>

<div class="navbar" id="navbar">
    <div class="navbar-left"></div>
    <div class="navbar-right">
        <button class="button">Bienvenido: Usuario 1</button>
        <button class="button">Soporte</button>
        <br>
    </div>
</div>
