using Acessai.Data.Context;
using Acessai.Data.Repository;
using Acessai.Domain.Interfaces.Repository;
using Acessai.Domain.Interfaces.Services;
using Acessai.Service;
using Microsoft.Extensions.WebEncoders.Testing;
using System.Data.Common;

var builder = WebApplication.CreateBuilder(args);

// Add services to the container.
builder.Services.AddControllers();

// Conexao banco de dados
builder.Services.AddSingleton(new DbConnectionStringBuilder
{
    ConnectionString = builder.Configuration.GetConnectionString("DefaultConnection")
});

var text = builder.Configuration.GetConnectionString("DefaultConnection");

builder.Services.AddSingleton<DataContext>();

// Repository
builder.Services.AddSingleton<IAlunoRepository, AlunoRepository>();

// Services
builder.Services.AddSingleton<IAlunoService, AlunoService>();

// Learn more about configuring Swagger/OpenAPI at https://aka.ms/aspnetcore/swashbuckle
builder.Services.AddEndpointsApiExplorer();
builder.Services.AddSwaggerGen();

var app = builder.Build();

// Configure the HTTP request pipeline.
if (app.Environment.IsDevelopment())
{
    app.UseSwagger();
    app.UseSwaggerUI();
}

app.UseHttpsRedirection();

app.UseAuthorization();

app.MapControllers();

app.Run();