import { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import "./login.css";

export const Login = () => {
    const [email, setEmail] = useState("");
    const [senha, setSenha] = useState("");
    const [mensagem, setMensagem] = useState("");
    const navigate = useNavigate();
    useEffect(() => {
        const verificarSessao = async () => {
            try {
                const response = await fetch("http://localhost/Projeto/trabalhoFullStack/backend/controller/checkSession_controller.php", {
                    method: "GET",
                    credentials: "include",
                });
                const data = await response.json();
                if (data.status) {
                    console.log(1)
                    navigate("/");
                }
            } catch (error) {
                console.error("Erro ao verificar a sessão:", error);
            }
        };

        verificarSessao();
    }, [navigate]);
    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            const response = await fetch("http://localhost/Projeto/trabalhoFullStack/backend/controller/login_controller.php", {
                method: "POST",
                 credentials: "include",
                body: JSON.stringify({ email, senha }),
            });

            const data = await response.json();

            if (data.status) {
                setMensagem(data.message);
                navigate("/");
            } else {
                setMensagem(data.message);
            }
        } catch (err) {
            console.error("Erro no login:", err);
            setMensagem("Erro ao efetuar o login. Tente novamente.");
        }
    };

    return (
        <div className="container">
            <div className="login-box">
              <h1>Login</h1>
              <form onSubmit={handleSubmit}>
                  <div>
                      <label htmlFor="email">E-mail</label>
                      <input type="email" id="email" name="email" value={email} onChange={(e) => setEmail(e.target.value)} required/>
                  </div>
                  <div>
                      <label htmlFor="senha">Senha</label>
                      <input type="password" id="senha" name="senha" value={senha} onChange={(e) => setSenha(e.target.value)} required/>
                  </div>
                  <button type="submit">Entrar</button>
              </form>
              {mensagem && <p>{mensagem}</p>}
            </div>
        </div>
    );
};
