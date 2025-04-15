import { useState } from "react";
import "./login.css";

export const Login = () => {
  const [email, setEmail] = useState("");
  const [senha, setSenha] = useState("");
  const [mensagem, setMensagem] = useState("");

  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      const response = await fetch("http://localhost/Projeto/trabalhoFullStack/backend/controller/login.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded", // Altere o cabeçalho para evitar OPTIONS
        },
        body: new URLSearchParams({ email, senha }).toString(), // Envia como form-urlencoded
      });

      const data = await response.json();

      if (data.response) {
        setMensagem("Login realizado com sucesso!");
        console.log("Usuário:", data.response);
      } else {
        setMensagem(data.error || "Erro ao fazer login.");
      }
    } catch (err) {
      console.error("Erro:", err);
      setMensagem("Erro na requisição.");
    }
  };

  return (
    <div className="container">
      <div className="login-box">
        <h1>Login</h1>
        <form onSubmit={handleSubmit}>
          <div>
            <label htmlFor="email">E-mail</label>
            <input
              type="email"
              id="email"
              name="email"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
            />
          </div>
          <div>
            <label htmlFor="senha">Senha</label>
            <input
              type="password"
              id="senha"
              name="senha"
              value={senha}
              onChange={(e) => setSenha(e.target.value)}
            />
          </div>
          <button type="submit">Entrar</button>
        </form>
        {mensagem && <p>{mensagem}</p>}
      </div>
    </div>
  );
};
