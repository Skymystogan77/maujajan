-- LocalScript: CutsceneExampleController.client.luau
-- Tempatkan di: StarterPlayer -> StarterPlayerScripts

local StarterPlayerScripts = script.Parent
local CutsceneManager = require(StarterPlayerScripts:WaitForChild("CutsceneManager"))

-- Contoh Penggunaan: Memulai Cutscene saat Player masuk / Trigger tertentu
local function runDemoCutscene()
	print("🎬 Memulai Cutscene...")
	
	-- 1. Jalankan Cutscene (Bar Hitam Full Edge-to-Edge di HP + Analog Hilang)
	CutsceneManager.StartCutscene(0.12) -- 12% tinggi layar

	-- 2. Kamera Cutscene Anda Berjalan Di Sini
	-- (Tambahkan logika Tween Camera Anda di sini)
	task.wait(5) -- Simulasi durasi cutscene 5 detik

	-- 3. Hentikan Cutscene (Bar Hitam Hilang + Analog & Core UI Muncul Kembali)
	CutsceneManager.StopCutscene()
	print("✅ Cutscene Selesai!")
end

-- Jalankan Demo Cutscene saat Play
task.delay(2, runDemoCutscene)
