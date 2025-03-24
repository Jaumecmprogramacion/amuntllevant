from flask import Flask
import subprocess

app = Flask(__name__)

@app.route('/ejecutar')
def ejecutar_scripts():
    # Ejecutar sacaresta.py
    resultado1 = subprocess.run(["python", "sacaresta.py"], capture_output=True, text=True)

    # Ejecutar lidereslevante.py
    resultado2 = subprocess.run(["python", "lidereslevante.py"], capture_output=True, text=True)

    # Retornar ambos resultados en la página
    return f"""
    <h2>Salida de sacaresta.py:</h2>
    <pre>{resultado1.stdout}</pre>
    <h2>Salida de lidereslevante.py:</h2>
    <pre>{resultado2.stdout}</pre>
    """

if __name__ == '__main__':
    app.run(debug=True)
