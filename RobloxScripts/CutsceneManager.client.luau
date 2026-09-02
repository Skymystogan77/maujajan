-- LocalScript: CutsceneManager.client.luau
-- Tempatkan di: StarterPlayer -> StarterPlayerScripts

local Players = game:GetService("Players")
local TweenService = game:GetService("TweenService")
local StarterGui = game:GetService("StarterGui")

local LocalPlayer = Players.LocalPlayer

-- Modul kontrol bawaan Roblox untuk mematikan Analog / Joystick di Mobile
local PlayerScripts = LocalPlayer:WaitForChild("PlayerScripts")
local PlayerModule = require(PlayerScripts:WaitForChild("PlayerModule"))
local Controls = PlayerModule:GetControls()

local CutsceneManager = {}
local currentCutsceneGui = nil

-- Fungsi membuat UI Bar Hitam Full Screen (Edge-to-Edge menutupi Notch / Safe Area HP)
local function createCutsceneUI()
	local screenGui = Instance.new("ScreenGui")
	screenGui.Name = "CinematicCutsceneGui"
	
	-- PENTING: Buka hingga ke tepi paling luar layar HP (Mengabaikan Notch / Insets)
	screenGui.IgnoreGuiInset = true
	pcall(function()
		screenGui.ScreenInsets = Enum.ScreenInsets.None
	end)
	
	screenGui.ResetOnSpawn = false
	screenGui.ZIndexBehavior = Enum.ZIndexBehavior.Sibling
	screenGui.DisplayOrder = 999
	screenGui.Parent = LocalPlayer:WaitForChild("PlayerGui")

	-- Bar Hitam Atas
	local topBar = Instance.new("Frame")
	topBar.Name = "TopBar"
	topBar.BackgroundColor3 = Color3.fromRGB(0, 0, 0)
	topBar.BorderSizePixel = 0
	topBar.Size = UDim2.new(1, 0, 0, 0) -- Mulai dari tinggi 0
	topBar.Position = UDim2.new(0, 0, 0, 0)
	topBar.Parent = screenGui

	-- Bar Hitam Bawah
	local bottomBar = Instance.new("Frame")
	bottomBar.Name = "BottomBar"
	bottomBar.BackgroundColor3 = Color3.fromRGB(0, 0, 0)
	bottomBar.BorderSizePixel = 0
	bottomBar.Size = UDim2.new(1, 0, 0, 0) -- Mulai dari tinggi 0
	bottomBar.Position = UDim2.new(0, 0, 1, 0)
	bottomBar.AnchorPoint = Vector2.new(0, 1)
	bottomBar.Parent = screenGui

	return screenGui, topBar, bottomBar
end

-- 🟢 FUNGSI MULAI CUTSCENE
function CutsceneManager.StartCutscene(barHeightPercent)
	barHeightPercent = barHeightPercent or 0.12 -- 12% dari tinggi layar

	-- 1. Sembunyikan Analog Movement & Tombol Lompat Mobile
	Controls:Disable()

	-- 2. Sembunyikan UI Bawaan Roblox (Chat, Backpack, Touch UI)
	pcall(function()
		StarterGui:SetCoreGuiEnabled(Enum.CoreGuiType.All, false)
	end)

	-- 3. Animasi Bar Hitam Full Layar
	local screenGui, topBar, bottomBar = createCutsceneUI()
	currentCutsceneGui = screenGui

	local tweenInfo = TweenInfo.new(0.6, Enum.EasingStyle.Quart, Enum.EasingDirection.Out)

	TweenService:Create(topBar, tweenInfo, {
		Size = UDim2.new(1, 0, barHeightPercent, 0)
	}):Play()

	TweenService:Create(bottomBar, tweenInfo, {
		Size = UDim2.new(1, 0, barHeightPercent, 0)
	}):Play()
end

-- 🔴 FUNGSI SELESAI CUTSCENE
function CutsceneManager.StopCutscene()
	if currentCutsceneGui then
		local topBar = currentCutsceneGui:FindFirstChild("TopBar")
		local bottomBar = currentCutsceneGui:FindFirstChild("BottomBar")
		local tweenInfo = TweenInfo.new(0.5, Enum.EasingStyle.Quart, Enum.EasingDirection.In)

		if topBar and bottomBar then
			local t1 = TweenService:Create(topBar, tweenInfo, {Size = UDim2.new(1, 0, 0, 0)})
			local t2 = TweenService:Create(bottomBar, tweenInfo, {Size = UDim2.new(1, 0, 0, 0)})
			t1:Play()
			t2:Play()
			t2.Completed:Wait()
		end
		currentCutsceneGui:Destroy()
		currentCutsceneGui = nil
	end

	-- 1. Kembalikan Analog Movement Mobile
	Controls:Enable()

	-- 2. Munculkan Kembali UI Utama Roblox
	pcall(function()
		StarterGui:SetCoreGuiEnabled(Enum.CoreGuiType.All, true)
	end)
end

return CutsceneManager
