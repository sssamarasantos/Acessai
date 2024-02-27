using Acessai.Data.Context;
using Acessai.Data.Repositories;
using Acessai.Data.Repository;
using Acessai.Domain.Interfaces.Repositories;
using Acessai.Domain.Interfaces.Repository;
using Acessai.Domain.Interfaces.Services;
using Acessai.Service;
using Acessai.Service.Services;
using System.Data.Common;

var builder = WebApplication.CreateBuilder(args);

// Add services to the container.
builder.Services.AddControllers();

// Conexao banco de dados
builder.Services.AddSingleton(new DbConnectionStringBuilder
{
    ConnectionString = builder.Configuration.GetConnectionString("DefaultConnection")
});

builder.Services.AddSingleton<DataContext>();

// Repository
builder.Services.AddSingleton<IAlunoRepository, AlunoRepository>();
builder.Services.AddSingleton<IDisciplinaRepository, DisciplinaRepository>();
builder.Services.AddSingleton<IAulaRepository, AulaRepository>();

// Services
builder.Services.AddSingleton<IAlunoService, AlunoService>();
builder.Services.AddSingleton<IDisciplinaService, DisciplinaService>();
builder.Services.AddSingleton<IAulaService, AulaService>();

// Mapper
builder.Services.AddAutoMapper(AppDomain.CurrentDomain.GetAssemblies());

builder.Services.AddCors(options =>
{
    options.AddPolicy("AllowSpecificOrigins",
        builder =>
        {
            builder.WithOrigins("http://seusite.com")
                   .AllowAnyHeader()
                   .AllowAnyMethod();
        });
});

// Learn more about configuring Swagger/OpenAPI at https://aka.ms/aspnetcore/swashbuckle
builder.Services.AddEndpointsApiExplorer();
builder.Services.AddSwaggerGen();

var app = builder.Build();

// Configure the HTTP request pipeline.
if (app.Environment.IsDevelopment())
{
    app.UseSwagger();
    app.UseSwaggerUI();
    app.UseCors("AllowSpecificOrigins");
}

//app.UseHttpsRedirection();

app.UseAuthorization();

app.MapControllers();

app.Run();
