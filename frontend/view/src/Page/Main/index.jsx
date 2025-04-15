import { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import './main.css';

export const Main = () => {
    const [mensagem, setMensagem] = useState("");
    const navigate = useNavigate();

    useEffect(() => {
        const verificarSessao = async () => {
            try {
                const response = await fetch("http://localhost/Projeto/trabalhoFullStack/backend/controller/checkSession.php", {
                    method: "GET",
                    credentials: "include",
                });
                const data = await response.json();

                if (data.status) {
                    setMensagem(data.usuario.nome_usuario);
                } else {
                    console.log("Sessão inválida:", data.message);
                    navigate("/login");
                }
            } catch (error) {
                console.error("Erro ao verificar a sessão:", error);
                navigate("/login");
            }
        };

        verificarSessao();
    }, [navigate]);

    const handleLogout = async () => {
        try {
            const response = await fetch("http://localhost/Projeto/trabalhoFullStack/backend/controller/logout.php", {
                method: "POST",
                credentials: "include",
            });

            

            navigate("/login");
            window.location.reload();
        
            
        } catch (error) {
            console.error("Erro ao fazer logout:", error);
        }
    };

    return (
        <div>
            <h1>Página Principal</h1>
            <div className="msg">
                Bem vindo,
                <span className="name_user">{mensagem}</span>!
            </div>
            <button onClick={handleLogout}>Sair</button>
        </div>
    );
};
