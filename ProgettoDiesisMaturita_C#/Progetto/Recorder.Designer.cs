namespace Progetto
{
    partial class Recorder
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
            this.groupBox2 = new System.Windows.Forms.GroupBox();
            this.groupBox4 = new System.Windows.Forms.GroupBox();
            this.textBox_BPM = new System.Windows.Forms.TextBox();
            this.Recorder_StopButton = new System.Windows.Forms.Button();
            this.groupBox3 = new System.Windows.Forms.GroupBox();
            this.label1 = new System.Windows.Forms.Label();
            this.Recorder_RecButton = new System.Windows.Forms.Button();
            this.Recorder_BackButton = new System.Windows.Forms.Button();
            this.groupBox2.SuspendLayout();
            this.groupBox4.SuspendLayout();
            this.groupBox3.SuspendLayout();
            this.SuspendLayout();
            // 
            // groupBox2
            // 
            this.groupBox2.Controls.Add(this.groupBox4);
            this.groupBox2.Controls.Add(this.Recorder_StopButton);
            this.groupBox2.Controls.Add(this.groupBox3);
            this.groupBox2.Controls.Add(this.Recorder_RecButton);
            this.groupBox2.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.groupBox2.ForeColor = System.Drawing.Color.Navy;
            this.groupBox2.Location = new System.Drawing.Point(106, 57);
            this.groupBox2.Name = "groupBox2";
            this.groupBox2.Size = new System.Drawing.Size(662, 149);
            this.groupBox2.TabIndex = 1;
            this.groupBox2.TabStop = false;
            this.groupBox2.Text = "Registra una nuova traccia";
            // 
            // groupBox4
            // 
            this.groupBox4.Controls.Add(this.textBox_BPM);
            this.groupBox4.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.groupBox4.ForeColor = System.Drawing.Color.Navy;
            this.groupBox4.Location = new System.Drawing.Point(263, 21);
            this.groupBox4.Name = "groupBox4";
            this.groupBox4.Size = new System.Drawing.Size(121, 63);
            this.groupBox4.TabIndex = 4;
            this.groupBox4.TabStop = false;
            this.groupBox4.Text = "BPM";
            // 
            // textBox_BPM
            // 
            this.textBox_BPM.Location = new System.Drawing.Point(15, 22);
            this.textBox_BPM.Name = "textBox_BPM";
            this.textBox_BPM.Size = new System.Drawing.Size(100, 22);
            this.textBox_BPM.TabIndex = 2;
            // 
            // Recorder_StopButton
            // 
            this.Recorder_StopButton.Location = new System.Drawing.Point(138, 24);
            this.Recorder_StopButton.Name = "Recorder_StopButton";
            this.Recorder_StopButton.Size = new System.Drawing.Size(76, 63);
            this.Recorder_StopButton.TabIndex = 3;
            this.Recorder_StopButton.Text = "STOP ||";
            this.Recorder_StopButton.UseVisualStyleBackColor = true;
            this.Recorder_StopButton.Click += new System.EventHandler(this.Recorder_StopButton_Click);
            // 
            // groupBox3
            // 
            this.groupBox3.Controls.Add(this.label1);
            this.groupBox3.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.groupBox3.ForeColor = System.Drawing.Color.Navy;
            this.groupBox3.Location = new System.Drawing.Point(390, 21);
            this.groupBox3.Name = "groupBox3";
            this.groupBox3.Size = new System.Drawing.Size(121, 63);
            this.groupBox3.TabIndex = 2;
            this.groupBox3.TabStop = false;
            this.groupBox3.Text = "Cronometro";
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Font = new System.Drawing.Font("Microsoft Sans Serif", 11.25F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label1.ForeColor = System.Drawing.SystemColors.Highlight;
            this.label1.Location = new System.Drawing.Point(41, 24);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(64, 18);
            this.label1.TabIndex = 0;
            this.label1.Text = "00:00:00";
            // 
            // Recorder_RecButton
            // 
            this.Recorder_RecButton.Location = new System.Drawing.Point(25, 22);
            this.Recorder_RecButton.Name = "Recorder_RecButton";
            this.Recorder_RecButton.Size = new System.Drawing.Size(93, 63);
            this.Recorder_RecButton.TabIndex = 0;
            this.Recorder_RecButton.Text = "REGISTRA >";
            this.Recorder_RecButton.UseVisualStyleBackColor = true;
            this.Recorder_RecButton.Click += new System.EventHandler(this.Recorder_RecButton_Click);
            // 
            // Recorder_BackButton
            // 
            this.Recorder_BackButton.Location = new System.Drawing.Point(244, 276);
            this.Recorder_BackButton.Name = "Recorder_BackButton";
            this.Recorder_BackButton.Size = new System.Drawing.Size(189, 43);
            this.Recorder_BackButton.TabIndex = 5;
            this.Recorder_BackButton.Text = "Back To Menu";
            this.Recorder_BackButton.UseVisualStyleBackColor = true;
            this.Recorder_BackButton.Click += new System.EventHandler(this.Recorder_BackButton_Click);
            // 
            // Recorder
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(1033, 369);
            this.Controls.Add(this.Recorder_BackButton);
            this.Controls.Add(this.groupBox2);
            this.Name = "Recorder";
            this.Text = "Recorder";
            this.groupBox2.ResumeLayout(false);
            this.groupBox4.ResumeLayout(false);
            this.groupBox4.PerformLayout();
            this.groupBox3.ResumeLayout(false);
            this.groupBox3.PerformLayout();
            this.ResumeLayout(false);

        }

        #endregion

        private System.Windows.Forms.GroupBox groupBox2;
        private System.Windows.Forms.GroupBox groupBox4;
        private System.Windows.Forms.TextBox textBox_BPM;
        private System.Windows.Forms.Button Recorder_StopButton;
        private System.Windows.Forms.GroupBox groupBox3;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Button Recorder_RecButton;
        private System.Windows.Forms.Button Recorder_BackButton;
    }
}