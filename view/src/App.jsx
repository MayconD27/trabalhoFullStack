import { useState } from 'react'
import reactLogo from './assets/react.svg'
import viteLogo from '/vite.svg'
import './App.css'

import './App.css';

function App() {
  return (
    <div className="container">
      <div className="login-box">
        <h1>Login</h1>
        <form>
          <div>
            <label htmlFor="usuario">Usuário</label>
            <input type="text" id="usuario" name="usuario" />
          </div>
          <div>
            <label htmlFor="senha">Senha</label>
            <input type="password" id="senha" name="senha" />
          </div>
          <button type="submit">Entrar</button>
        </form>
      </div>
    </div>
  );
}

export default App;
