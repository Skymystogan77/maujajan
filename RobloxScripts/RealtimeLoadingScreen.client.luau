-- LocalScript: RealtimeLoadingScreen.client.luau
-- Tempatkan di: ReplicatedFirst

local ReplicatedFirst = game:GetService("ReplicatedFirst")
local ContentProvider = game:GetService("ContentProvider")
local TweenService = game:GetService("TweenService")
local Players = game:GetService("Players")
local RunService = game:GetService("RunService")

local LocalPlayer = Players.LocalPlayer
local PlayerGui = LocalPlayer:WaitForChild("PlayerGui")

-- Matikan Loading Screen bawaan Roblox
ReplicatedFirst:RemoveDefaultLoadingScreen()

-- 1. BUAT UI LOADING SCREEN REALTIME (Edge-to-Edge full mobile screen)
local loadingGui = Instance.new("ScreenGui")
loadingGui.Name = "RealtimeLoadingGui"
loadingGui.IgnoreGuiInset = true -- Full screen di HP / Notch
pcall(function()
	loadingGui.ScreenInsets = Enum.ScreenInsets.None
end)
loadingGui.DisplayOrder = 1000 -- Selalu paling depan
loadingGui.Parent = PlayerGui

-- Background Utama
local bg = Instance.new("Frame")
bg.Size = UDim2.new(1, 0, 1, 0)
bg.BackgroundColor3 = Color3.fromRGB(12, 12, 16)
bg.BorderSizePixel = 0
bg.Parent = loadingGui

-- Judul Game
local titleLabel = Instance.new("TextLabel")
titleLabel.Size = UDim2.new(0.8, 0, 0.1, 0)
titleLabel.Position = UDim2.new(0.5, 0, 0.4, 0)
titleLabel.AnchorPoint = Vector2.new(0.5, 0.5)
titleLabel.BackgroundTransparency = 1
titleLabel.Font = Enum.Font.GothamBold
titleLabel.Text = "LOADING GAME..."
titleLabel.TextColor3 = Color3.fromRGB(255, 255, 255)
titleLabel.TextSize = 28
titleLabel.Parent = bg

-- Status Teks Realtime
local statusLabel = Instance.new("TextLabel")
statusLabel.Size = UDim2.new(0.8, 0, 0.05, 0)
statusLabel.Position = UDim2.new(0.5, 0, 0.68, 0)
statusLabel.AnchorPoint = Vector2.new(0.5, 0.5)
statusLabel.BackgroundTransparency = 1
statusLabel.Font = Enum.Font.GothamMedium
statusLabel.Text = "Menyiapkan koneksi..."
statusLabel.TextColor3 = Color3.fromRGB(200, 200, 210)
statusLabel.TextSize = 15
statusLabel.Parent = bg

-- Bar Frame
local barOutline = Instance.new("Frame")
barOutline.Size = UDim2.new(0.5, 0, 0.012, 0)
barOutline.Position = UDim2.new(0.5, 0, 0.74, 0)
barOutline.AnchorPoint = Vector2.new(0.5, 0.5)
barOutline.BackgroundColor3 = Color3.fromRGB(35, 35, 45)
barOutline.BorderSizePixel = 0
barOutline.Parent = bg

-- Progress Fill (Biru)
local barFill = Instance.new("Frame")
barFill.Size = UDim2.new(0, 0, 1, 0)
barFill.BackgroundColor3 = Color3.fromRGB(0, 162, 255)
barFill.BorderSizePixel = 0
barFill.Parent = barOutline

-- Persentase (0%)
local percentLabel = Instance.new("TextLabel")
percentLabel.Size = UDim2.new(0.5, 0, 0.04, 0)
percentLabel.Position = UDim2.new(0.5, 0, 0.79, 0)
percentLabel.AnchorPoint = Vector2.new(0.5, 0.5)
percentLabel.BackgroundTransparency = 1
percentLabel.Font = Enum.Font.GothamBold
percentLabel.Text = "0%"
percentLabel.TextColor3 = Color3.fromRGB(0, 162, 255)
percentLabel.TextSize = 14
percentLabel.Parent = bg

-- 2. DENGAR SISA PRELOAD GAME & RENDER
if not game:IsLoaded() then
	game.Loaded:Wait()
end

local instancesToLoad = workspace:GetDescendants()
local totalCount = math.max(#instancesToLoad, 1)
local loadedCount = 0

for i, obj in ipairs(instancesToLoad) do
	pcall(function()
		ContentProvider:PreloadAsync({obj})
	end)
	loadedCount = i

	local progress = math.clamp(loadedCount / totalCount, 0, 1)
	
	barFill:TweenSize(
		UDim2.new(progress, 0, 1, 0),
		Enum.EasingDirection.Out,
		Enum.EasingStyle.Quad,
		0.05,
		true
	)
	
	percentLabel.Text = math.floor(progress * 100) .. "%"
	statusLabel.Text = string.format("Memuat Asset & Render (%d/%d)", loadedCount, totalCount)

	if i % 10 == 0 then
		task.wait()
	end
end

-- 3. FINALLISASI RENDER 3D
statusLabel.Text = "Memproses Render 3D World..."
percentLabel.Text = "100%"
barFill.Size = UDim2.new(1, 0, 1, 0)

for frame = 1, 30 do
	RunService.RenderStepped:Wait()
end

task.wait(0.3)
statusLabel.Text = "Siap!"

local fadeTween = TweenService:Create(bg, TweenInfo.new(0.8, Enum.EasingStyle.Sine, Enum.EasingDirection.Out), {
	BackgroundTransparency = 1
})
fadeTween:Play()
fadeTween.Completed:Wait()

loadingGui:Destroy()
