import os
from telegram import Update, InlineKeyboardButton, InlineKeyboardMarkup
from telegram.ext import (
    ApplicationBuilder,
    CommandHandler,
    MessageHandler,
    filters,
    ContextTypes,
)

# Token from environment variable
BOT_TOKEN = os.getenv("BOT_TOKEN")

# /start command
async def start(update: Update, context: ContextTypes.DEFAULT_TYPE):
    keyboard = [
        [InlineKeyboardButton("📚 Courses", url="https://yourcoursesite.com")],
        [InlineKeyboardButton("📢 Updates", url="https://t.me/YourChannel")]
    ]
    reply_markup = InlineKeyboardMarkup(keyboard)
    await update.message.reply_text(
        "👋 Welcome to SkillzUp!\nGet updates, courses & more.",
        reply_markup=reply_markup
    )

# /help command
async def help_command(update: Update, context: ContextTypes.DEFAULT_TYPE):
    await update.message.reply_text(
        "/start - Welcome message\n/help - Command list\n/rules - Group rules\n/support - Help contact"
    )

# /rules command
async def rules(update: Update, context: ContextTypes.DEFAULT_TYPE):
    await update.message.reply_text(
        "📌 Group Rules:\n1. Be respectful\n2. No spam\n3. Stay on topic"
    )

# /support command
async def support(update: Update, context: ContextTypes.DEFAULT_TYPE):
    await update.message.reply_text("💬 Support: @YourSupportUsername")

# Helper function to check admin
def is_admin(user_id, chat_admins):
    return any(admin.user.id == user_id for admin in chat_admins)

# /ban command (admin only)
async def ban(update: Update, context: ContextTypes.DEFAULT_TYPE):
    if update.message.reply_to_message:
        chat_admins = await context.bot.get_chat_administrators(update.effective_chat.id)
        if is_admin(update.effective_user.id, chat_admins):
            user_id = update.message.reply_to_message.from_user.id
            await context.bot.ban_chat_member(update.effective_chat.id, user_id)
            await update.message.reply_text("🚫 User banned.")
        else:
            await update.message.reply_text("❌ Only admins can use this command.")

# /mute command (coming soon)
async def mute(update: Update, context: ContextTypes.DEFAULT_TYPE):
    await update.message.reply_text("🔇 Mute feature coming soon!")

# Main function
def main():
    app = ApplicationBuilder().token(BOT_TOKEN).build()
    app.add_handler(CommandHandler("start", start))
    app.add_handler(CommandHandler("help", help_command))
    app.add_handler(CommandHandler("rules", rules))
    app.add_handler(CommandHandler("support", support))
    app.add_handler(CommandHandler("ban", ban))
    app.add_handler(CommandHandler("mute", mute))
    print("✅ Bot is running...")
    app.run_polling()

if __name__ == "__main__":
    main()
