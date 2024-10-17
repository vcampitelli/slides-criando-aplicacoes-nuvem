import {Link} from 'react-router-dom';

function Home() {
    return (
        <div className="p-5 mb-4 bg-body-tertiary rounded-3">
            <div className="container-fluid py-5">
                <h1 className="display-5 fw-bold">Bem-vindo!</h1>
                <p className="col-md-8 fs-4">
                    Essa é uma aplicação para demonstrar um <em>frontend</em> rodando na Nuvem
                </p>
                <Link to="/users" className="btn btn-primary btn-lg">
                    Listar usuários
                </Link>
            </div>
        </div>
    );
}

export default Home;
