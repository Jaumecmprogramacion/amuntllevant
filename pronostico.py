import requests

API_KEY = "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"  # Reemplázala con tu clave de OpenRouter
URL = "https://openrouter.ai/api/v1/chat/completions"

headers = {
    "Authorization": f"Bearer {API_KEY}",
    "Content-Type": "application/json"
}

data = {
    "model": "openai/gpt-4-turbo",  # Usa "openai/gpt-3.5-turbo" si prefieres
    "messages": [{"role": "user", "content": "Hola, ¿cómo estás?"}]
}

response = requests.post(URL, headers=headers, json=data)
print(response.json())  # Devuelve la respuesta en JSON
