import { useState } from 'react'
import './login.css'


export const Login = () => {
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


