<div style="font-family: 'Inter', 'Segoe UI', sans-serif; max-width: 800px; margin: 0 auto; padding: 24px; background-color: #1a202c; border-radius: 12px; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);">
    <h1 style="color: #f7fafc; text-align: center; font-size: 2.5rem; font-weight: 700; padding-bottom: 25px; margin-bottom: 30px; border-bottom: 1px solid #4a5568; position: relative;">
        <span style="background: linear-gradient(45deg, #667eea, #764ba2); -webkit-background-clip: text; background-clip: text; color: transparent;">Polly Text-to-Speech</span>
        <span style="display: block; font-size: 1rem; font-weight: normal; color: #a0aec0; margin-top: 8px;">Convierte texto a voz natural</span>
    </h1>

    @if ($errors->any())
        <div style="background-color: rgba(229, 62, 62, 0.1); border-left: 4px solid #e53e3e; color: #fc8181; padding: 15px; border-radius: 6px; margin-bottom: 24px; animation: fadeIn 0.3s ease-in-out;">
            <div style="display: flex; align-items: center; margin-bottom: 8px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 10px;"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                <span style="font-weight: 600;">Error</span>
            </div>
            <ul style="list-style-type: none; margin-left: 10px; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li style="position: relative; margin-bottom: 6px;">
                        <span style="position: absolute; left: -20px; top: 6px; width: 6px; height: 6px; border-radius: 50%; background-color: #fc8181;"></span>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    
    @if (session()->has('success'))
        <div style="background-color: rgba(72, 187, 120, 0.1); border-left: 4px solid #48bb78; color: #9ae6b4; padding: 15px; border-radius: 6px; margin-bottom: 24px; display: flex; align-items: center; animation: fadeIn 0.3s ease-in-out;">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 10px;"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
            <span style="font-weight: 500;">{{ session('success') }}</span>
        </div>
    @endif

    <div style="padding: 30px; background-color: #2d3748; border-radius: 12px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15); margin-bottom: 24px; transition: all 0.3s ease;">
        <label for="text" style="display: block; margin-bottom: 12px; color: #cbd5e0; font-weight: 600; font-size: 1.1rem;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px; vertical-align: middle;"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
            Texto a convertir:
        </label>
        <textarea 
            wire:model="text" 
            id="text" 
            rows="6" 
            placeholder="Escribe o pega el texto que deseas convertir a audio..."
            style="width: 100%; padding: 14px; border: 1px solid #4a5568; border-radius: 8px; background-color: #4a5568; color: #f7fafc; font-family: sans-serif; font-size: 16px; box-sizing: border-box; resize: vertical; transition: all 0.2s ease; box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);"
            onfocus="this.style.borderColor='#667eea'; this.style.boxShadow='0 0 0 3px rgba(102, 126, 234, 0.3)';"
            onblur="this.style.borderColor='#4a5568'; this.style.boxShadow='inset 0 2px 4px rgba(0, 0, 0, 0.1)';"
        ></textarea>
    </div>

    <div style="display: flex; gap: 20px; flex-wrap: wrap; margin-bottom: 24px;">
        <div style="flex: 1; min-width: 200px; padding: 20px; background-color: #2d3748; border-radius: 12px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);">
            <label for="voiceId" style="display: flex; align-items: center; color: #cbd5e0; font-weight: 600; margin-bottom: 12px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;"><path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"></path><path d="M19 10v2a7 7 0 0 1-14 0v-2"></path><line x1="12" y1="19" x2="12" y2="23"></line><line x1="8" y1="23" x2="16" y2="23"></line></svg>
                Selecciona la voz:
            </label>
            <div style="position: relative;">
                <select 
                    wire:model="voiceId" 
                    id="voiceId" 
                    style="width: 100%; padding: 12px 35px 12px 15px; border: 1px solid #4a5568; border-radius: 8px; background-color: #4a5568; color: #f7fafc; font-family: sans-serif; font-size: 16px; appearance: none; -webkit-appearance: none; transition: all 0.2s ease; cursor: pointer; box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);"
                    onfocus="this.style.borderColor='#667eea'; this.style.boxShadow='0 0 0 3px rgba(102, 126, 234, 0.3)';"
                    onblur="this.style.borderColor='#4a5568'; this.style.boxShadow='inset 0 2px 4px rgba(0, 0, 0, 0.1)';"
                >
                    <option value="Amy">Amy</option>
                    <option value="Ricardo">Ricardo</option>
                    <option value="Conchita">Conchita</option>
                    <option value="Enrique">Enrique</option>
                    <option value="Lucia">Lucia</option>
                </select>
                <div style="position: absolute; top: 50%; right: 15px; transform: translateY(-50%); pointer-events: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#a0aec0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </div>
            </div>
        </div>
        
        <div style="flex: 1; min-width: 200px; padding: 20px; background-color: #2d3748; border-radius: 12px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);">
            <label for="languageCode" style="display: flex; align-items: center; color: #cbd5e0; font-weight: 600; margin-bottom: 12px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                Selecciona el idioma:
            </label>
            <div style="position: relative;">
                <select 
                    wire:model="languageCode" 
                    id="languageCode" 
                    style="width: 100%; padding: 12px 35px 12px 15px; border: 1px solid #4a5568; border-radius: 8px; background-color: #4a5568; color: #f7fafc; font-family: sans-serif; font-size: 16px; appearance: none; -webkit-appearance: none; transition: all 0.2s ease; cursor: pointer; box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);"
                    onfocus="this.style.borderColor='#667eea'; this.style.boxShadow='0 0 0 3px rgba(102, 126, 234, 0.3)';"
                    onblur="this.style.borderColor='#4a5568'; this.style.boxShadow='inset 0 2px 4px rgba(0, 0, 0, 0.1)';"
                >
                    <option value="es-ES">Español (España)</option>
                    <option value="es-US">Español (EE.UU.)</option>
                </select>
                <div style="position: absolute; top: 50%; right: 15px; transform: translateY(-50%); pointer-events: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#a0aec0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </div>
            </div>
        </div>
    </div>
    
    <div style="text-align: center; margin-top: 30px;">
        <button 
            wire:click="generatePolly" 
            wire:loading.attr="disabled" 
            style="background: linear-gradient(45deg, #667eea, #764ba2); color: #f7fafc; padding: 14px 32px; border: none; border-radius: 8px; cursor: pointer; font-size: 16px; font-weight: 600; letter-spacing: 0.5px; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3); position: relative; overflow: hidden;"
            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(102, 126, 234, 0.4)';"
            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(102, 126, 234, 0.3)';"
        >
            <span wire:loading.remove style="display: flex; align-items: center; justify-content: center;">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;"><polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon><path d="M19.07 4.93a10 10 0 0 1 0 14.14M15.54 8.46a5 5 0 0 1 0 7.07"></path></svg>
                Generar Audio
            </span>
            <span wire:loading style="display: flex; align-items: center; justify-content: center;">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px; animation: spin 1.5s linear infinite;"><path d="M21 12a9 9 0 1 1-6.219-8.56"></path></svg>
                Generando...
            </span>
        </button>
    </div>

    <div style="margin-top: 30px; padding: 15px; border-top: 1px solid #4a5568; color: #a0aec0; font-size: 14px; text-align: center;">
        <p>Powered by AWS Polly</p>
    </div>


    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</div>