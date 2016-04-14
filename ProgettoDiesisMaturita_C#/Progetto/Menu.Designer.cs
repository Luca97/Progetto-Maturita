namespace Progetto
{
    partial class Menu
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.menu_LogoutButton = new System.Windows.Forms.Button();
            this.menu_RecorderButton = new System.Windows.Forms.Button();
            this.menu_ModificaDatiButton = new System.Windows.Forms.Button();
            this.menu_VisualizzaButton = new System.Windows.Forms.Button();
            this.SuspendLayout();
            // 
            // menu_LogoutButton
            // 
            this.menu_LogoutButton.Location = new System.Drawing.Point(244, 298);
            this.menu_LogoutButton.Name = "menu_LogoutButton";
            this.menu_LogoutButton.Size = new System.Drawing.Size(330, 23);
            this.menu_LogoutButton.TabIndex = 0;
            this.menu_LogoutButton.Text = "Logout";
            this.menu_LogoutButton.UseVisualStyleBackColor = true;
            // 
            // menu_RecorderButton
            // 
            this.menu_RecorderButton.Location = new System.Drawing.Point(53, 124);
            this.menu_RecorderButton.Name = "menu_RecorderButton";
            this.menu_RecorderButton.Size = new System.Drawing.Size(158, 71);
            this.menu_RecorderButton.TabIndex = 1;
            this.menu_RecorderButton.Text = "Recorder";
            this.menu_RecorderButton.UseVisualStyleBackColor = true;
            this.menu_RecorderButton.Click += new System.EventHandler(this.menu_RecorderButton_Click);
            // 
            // menu_ModificaDatiButton
            // 
            this.menu_ModificaDatiButton.Location = new System.Drawing.Point(316, 124);
            this.menu_ModificaDatiButton.Name = "menu_ModificaDatiButton";
            this.menu_ModificaDatiButton.Size = new System.Drawing.Size(158, 71);
            this.menu_ModificaDatiButton.TabIndex = 2;
            this.menu_ModificaDatiButton.Text = "Modifica Dati Personali";
            this.menu_ModificaDatiButton.UseVisualStyleBackColor = true;
            this.menu_ModificaDatiButton.Click += new System.EventHandler(this.menu_ModificaDatiButton_Click);
            // 
            // menu_VisualizzaButton
            // 
            this.menu_VisualizzaButton.Location = new System.Drawing.Point(565, 124);
            this.menu_VisualizzaButton.Name = "menu_VisualizzaButton";
            this.menu_VisualizzaButton.Size = new System.Drawing.Size(158, 71);
            this.menu_VisualizzaButton.TabIndex = 3;
            this.menu_VisualizzaButton.Text = "Visualizza Tag";
            this.menu_VisualizzaButton.UseVisualStyleBackColor = true;
            this.menu_VisualizzaButton.Click += new System.EventHandler(this.menu_VisualizzaButton_Click);
            // 
            // Menu
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(806, 392);
            this.Controls.Add(this.menu_VisualizzaButton);
            this.Controls.Add(this.menu_ModificaDatiButton);
            this.Controls.Add(this.menu_RecorderButton);
            this.Controls.Add(this.menu_LogoutButton);
            this.Name = "Menu";
            this.Text = "Menu";
            this.Load += new System.EventHandler(this.Menu_Load);
            this.ResumeLayout(false);

        }

        #endregion

        private System.Windows.Forms.Button menu_LogoutButton;
        private System.Windows.Forms.Button menu_RecorderButton;
        private System.Windows.Forms.Button menu_ModificaDatiButton;
        private System.Windows.Forms.Button menu_VisualizzaButton;
    }
}